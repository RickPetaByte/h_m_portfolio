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
    public function updateHtml(Request $request, $fileName)
    {
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
        ]);

        $filePath = public_path($fileName);
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

        $user = Auth::user();
        $name = $user->name;

        // Determine new file name
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

        // Check if the template view exists
        $templateFile = $request->input('htmlTemplate');
        if (view()->exists($templateFile)) {
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
                'fileName' => $newFileName,
                'name' => $name,
            ])->render();

            File::put($newFilePath, $html);
            if ($filePath !== $newFilePath) {
                File::delete($filePath);
            }

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
                    'file_name' => $newFileName,
                ]);
            }

            return redirect('/' . $newFileName)->with('success', 'HTML file and database updated successfully.');
        } else {
            return back()->withInput()->withErrors(['htmlTemplate' => 'Template file not found.']);
        }
    }
    
    public function generateHtml($title, $subtitle, $text, $specialties, $one, $two, $three, $four, $five, $six, $selected_color_image_alt, $private)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user = Auth::user();
        $name = $user->name; 
    
        $fileName = Auth::user()->name . '-' . time() . '.html';
        $filePath = public_path($fileName);
    
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
            'fileName' => $fileName,
            'name' => $name, 
        ];
    
        $html = view('dynamic-template', $data)->render();
        File::put($filePath, $html);
    
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
        ]);
    
        return redirect($fileName)->with('success', 'HTML file generated successfully.');
    }

    public function showEditHtml($fileName)
    {
        $filePath = public_path($fileName);
        $htmlContent = File::get($filePath);

        return view('edit-html', compact('htmlContent', 'fileName'));
    }

    public function deletePortfolio(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
        ]);

        $fileName = $request->input('file_name');
        $filePath = public_path($fileName);

        if (File::exists($filePath)) {
            try {
                File::delete($filePath);

                $userText = UserText::where('user_id', Auth::id())->where('fileName', $fileName)->first();
                if ($userText) {
                    $userText->delete();
                }

                return redirect('/dashboard')->with('message', 'Bestand succesvol verwijderd');
            } catch (\Exception $e) {
                return redirect('/dashboard')->with('error', 'Er is een fout opgetreden bij het verwijderen van het bestand');
            }
        } else {
            return redirect('/dashboard')->with('error', 'Bestand niet gevonden');
        }
    }
}