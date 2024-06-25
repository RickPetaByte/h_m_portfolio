<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PortfolioController extends Controller
{
    // Update HTML file based on form submission.
    public function updateHtml(Request $request, $fileName)
    {
        // Validate incoming request data
        $request->validate([
            'htmlTitle' => 'required|string',
            'htmlSubTitle' => 'required|string',
            'htmlContent' => 'required|string',
            'htmlSpecialties' => 'required|string',
            'htmlOne' => 'required|string',
            'htmlTwo' => 'required|string',
            'htmlThree' => 'required|string',
            'htmlFour' => 'required|string',
            'htmlFive' => 'required|string',
            'htmlSix' => 'required|string',
            'htmlTemplate' => 'required|string',
            'htmlPicture' => 'required|string',
            'htmlLayoutUrl' => 'required|string',
            'htmlPrivacyValue' => 'required|string',
            'htmlFamily' => 'required|string',
        ]);

        // Original file path
        $filePath = public_path($fileName);

        // Extract request inputs
        $newTitle = $request->input('htmlTitle');
        $newSubTitle = $request->input('htmlSubTitle');
        $newContent = $request->input('htmlContent');
        $newSpecialties = $request->input('htmlSpecialties');
        $newOne = $request->input('htmlOne');
        $newTwo = $request->input('htmlTwo');
        $newThree = $request->input('htmlThree');
        $newFour = $request->input('htmlFour');
        $newFive = $request->input('htmlFive');
        $newSix = $request->input('htmlSix');
        $newLayoutUrl = $request->input('htmlLayoutUrl');
        $newPrivacyValue = $request->input('htmlPrivacyValue');
        $newFamily = $request->input('htmlFamily');

        // Get current authenticated user
        $user = Auth::user();
        $name = $user->name;

        // Determine new file name based on privacy setting
        $fileNameParts = pathinfo($fileName);
        $fileBaseName = $fileNameParts['filename'];
        $fileExtension = $fileNameParts['extension'];

        $newFileName = $fileBaseName;
        if (str_ends_with($fileBaseName, '-public')) {
            $newFileName = str_replace('-public', '', $fileBaseName);
        } elseif (str_ends_with($fileBaseName, '-private')) {
            $newFileName = str_replace('-private', '', $fileBaseName);
        }

        if ($newPrivacyValue == "0") {
            $newFileName .= '-public.' . $fileExtension;
        } else {
            $newFileName .= '-private.' . $fileExtension;
        }

        $newFilePath = public_path($newFileName);

        // Check if the selected template view exists
        $templateFile = $request->input('htmlTemplate');
        if (view()->exists($templateFile)) {
            // Render HTML from template with new data
            $html = View::make($templateFile, [
                'title' => $newTitle,
                'subtitle' => $newSubTitle,
                'text' => $newContent,
                'specialties' => $newSpecialties,
                'one' => $newOne,
                'two' => $newTwo,
                'three' => $newThree,
                'four' => $newFour,
                'five' => $newFive,
                'six' => $newSix,
                'selected_image_alt' => $request->input('htmlTemplate'),
                'picture' => $request->input('htmlPicture'),
                'selected_color_image_alt' => $newLayoutUrl,
                'private' => $newPrivacyValue,
                'family' => $newFamily,
                'fileName' => $newFileName,
                'name' => $name,
            ])->render();

            // Save rendered HTML to new file
            File::put($newFilePath, $html);

            // Delete old file if new file path differs
            if ($filePath !== $newFilePath) {
                File::delete($filePath);
            }

            // Update or create UserText model entry
            $userText = UserText::where('user_id', Auth::id())->first();
            if ($userText) {
                $userText->update([
                    'title' => $newTitle,
                    'subtitle' => $newSubTitle,
                    'text' => $newContent,
                    'specialties' => $newSpecialties,
                    'one' => $newOne,
                    'two' => $newTwo,
                    'three' => $newThree,
                    'four' => $newFour,
                    'five' => $newFive,
                    'six' => $newSix,
                    'selected_color_image_alt' => $newLayoutUrl,
                    'private' => $newPrivacyValue,
                    'family' => $newFamily,
                    'file_name' => $newFileName,
                ]);
            } else {
                UserText::create([
                    'user_id' => Auth::id(),
                    'title' => $newTitle,
                    'subtitle' => $newSubTitle,
                    'text' => $newContent,
                    'specialties' => $newSpecialties,
                    'one' => $newOne,
                    'two' => $newTwo,
                    'three' => $newThree,
                    'four' => $newFour,
                    'five' => $newFive,
                    'six' => $newSix,
                    'selected_color_image_alt' => $newLayoutUrl,
                    'private' => $newPrivacyValue,
                    'family' => $newFamily,
                    'file_name' => $newFileName,
                ]);
            }

            // Redirect with success message
            return redirect('/' . $newFileName)->with('success', 'HTML file and database updated successfully.');
        } else {
            // Redirect back with error if template file not found
            return back()->withInput()->withErrors(['htmlTemplate' => 'Template file not found.']);
        }
    }
    
    // Generate HTML file based on provided data.
    public function generateHtml($title, $subtitle, $text, $specialties, $one, $two, $three, $four, $five, $six, $selected_color_image_alt, $private, $family)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get current authenticated user's name
        $user = Auth::user();
        $name = $user->name;

        // Generate unique filename based on user and timestamp
        $fileName = Auth::user()->name . '-' . time() . '.html';
        $filePath = public_path($fileName);

        // Data to pass to view for HTML generation
        $data = [
            'title' => $title,
            'subtitle' => $subtitle,
            'text' => $text,
            'specialties' => $specialties,
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'four' => $four,
            'five' => $five,
            'six' => $six,
            'selected_color_image_alt' => $selected_color_image_alt,
            'private' => $private,
            'family' => $family,
            'fileName' => $fileName,
            'name' => $name,
        ];

        // Render HTML from dynamic-template view with data
        $html = view('dynamic-template', $data)->render();

        // Save rendered HTML to file
        File::put($filePath, $html);

        // Create UserText model entry for logged-in user
        UserText::create([
            'user_id' => Auth::id(),
            'title' => $title,
            'subtitle' => $subtitle,
            'text' => $text,
            'specialties' => $specialties,
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'four' => $four,
            'five' => $five,
            'six' => $six,
            'selected_color_image_alt' => $selected_color_image_alt,
            'private' => $private,
            'family' => $family,
        ]);

        // Redirect to generated HTML file with success message
        return redirect($fileName)->with('success', 'HTML file generated successfully.');
    }

    // Display the form to edit HTML content.
    public function showEditHtml($fileName)
    {
        // Read HTML content from file
        $filePath = public_path($fileName);
        $htmlContent = File::get($filePath);

        // Return view with HTML content for editing
        return view('edit-html', compact('htmlContent', 'fileName'));
    }

    // Delete portfolio entry and associated file.
    public function deletePortfolio(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'file_name' => 'required|string',
        ]);

        // Get file name from request
        $fileName = $request->input('file_name');
        $filePath = public_path($fileName);

        // Check if file exists
        if (File::exists($filePath)) {
            try {
                // Attempt to delete the file
                File::delete($filePath);

                // Find and delete associated UserText model entry
                $userText = UserText::where('user_id', Auth::id())->where('fileName', $fileName)->first();
                if ($userText) {
                    $userText->delete();
                }

                // Redirect with success message
                return redirect('/dashboard')->with('message', 'Bestand succesvol verwijderd');
            } catch (\Exception $e) {
                // Redirect with error message if deletion fails
                return redirect('/dashboard')->with('error', 'Er is een fout opgetreden bij het verwijderen van het bestand');
            }
        } else {
            // Redirect with error message if file not found
            return redirect('/dashboard')->with('error', 'Bestand niet gevonden');
        }
    }
}