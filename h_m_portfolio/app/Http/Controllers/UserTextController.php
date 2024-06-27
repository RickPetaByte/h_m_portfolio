<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class UserTextController extends Controller
{
    // Show the form for creating a new portfolio.
    public function showForm()
    {
        return view('create-portfolio');
    }

    // Store the user's portfolio text data.
    public function storeText(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'text' => 'required|string',
            'specialties' => 'required|string',
            'one' => 'required|string|max:255',
            'two' => 'required|string|max:255',
            'three' => 'required|string|max:255',
            'four' => 'required|string|max:255',
            'five' => 'required|string|max:255',
            'six' => 'required|string|max:255',
            'private' => 'required|boolean',
            'family' => 'required|string|max:255',
            'selected_image_alt' => 'required|string',
            'selected_color_image_alt' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle picture upload if provided
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures', 'public');
            $validatedData['picture'] = $picturePath;
        }

        // Update or create UserText model instance for the authenticated user
        UserText::updateOrCreate(
            ['user_id' => Auth::id()],
            $validatedData
        );

        // Generate HTML based on stored data
        return $this->generateHtml();
    }

    // Generate HTML portfolio based on stored user text data.
    public function generateHtml()
    {
        // Redirect to login if user is not authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Retrieve latest user text entry
        $userText = UserText::where('user_id', Auth::id())->latest()->first();

        // Redirect to create portfolio form if no user text found
        if (!$userText) {
            return redirect()->route('create-portfolio')->with('error', 'No text found for the user.');
        }

        // Prepare data for HTML rendering
        $data = [
            'title' => $userText->title,
            'subtitle' => $userText->subtitle,
            'text' => $userText->text,
            'specialties' => $userText->specialties,
            'one' => $userText->one,
            'two' => $userText->two,
            'three' => $userText->three,
            'four' => $userText->four,
            'five' => $userText->five,
            'six' => $userText->six,
            'private' => $userText->private,
            'family' => $userText->family,
            'selected_image_alt' => $userText->selected_image_alt,
            'selected_color_image_alt' => $userText->selected_color_image_alt,
            'fileName' => Auth::user()->name . '-' . time() . '-' . ($userText->private ? 'private' : 'public') . '.html',
            'name' => Auth::user()->name,
            'picture' => $userText->picture
        ];

        // Determine template name based on selected_image_alt
        $templateName = $userText->selected_image_alt;

        // Render HTML content from selected template
        $htmlContent = View::make($templateName, $data)->render();

        // Save rendered HTML to public directory
        File::put(public_path($data['fileName']), $htmlContent);

        // Redirect to generated HTML file with success message
        return redirect('/' . $data['fileName'])->with('success', 'Portfolio HTML file generated successfully.');
    }

    public function updateHtml(Request $request, $fileName)
    {
        $request->validate([
            'htmlTitle' => 'required|string',
            'htmlSubtitle' => 'required|string',
            'htmlText' => 'required|string',
            'htmlOne' => 'required|string',
            'htmlTwo' => 'required|string',
            'htmlThree' => 'required|string',
            'htmlFour' => 'required|string',
            'htmlFive' => 'required|string',
            'htmlSix' => 'required|string',
        ]);
    
        $filePath = public_path($fileName);
    
        $data = [
            'title' => $request->input('htmlTitle'),
            'subtitle' => $request->input('htmlSubtitle'),
            'text' => $request->input('htmlText'),
            'one' => $request->input('htmlOne'),
            'two' => $request->input('htmlTwo'),
            'three' => $request->input('htmlThree'),
            'four' => $request->input('htmlFour'),
            'five' => $request->input('htmlFive'),
            'six' => $request->input('htmlSix'),
            'fileName' => $fileName,
        ];
    
        File::put($filePath, View::make('dynamic-template', $data)->render());
    
        $userText = UserText::where('user_id', Auth::id())->first();
        if ($userText) {
            $userText->update($data);
        } else {
            UserText::create(array_merge($data, ['user_id' => Auth::id()]));
        }
    
        return redirect('/' . $fileName)->with('success', 'HTML file and database updated successfully.');
    }
}