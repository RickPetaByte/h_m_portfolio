<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class UserTextController extends Controller
{
    public function showForm()
    {
        return view('create-portfolio');
    }


    public function storeText(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'text' => 'required|string',
            'one' => 'required|string|max:255',
            'two' => 'required|string|max:255',
            'three' => 'required|string|max:255',
            'four' => 'required|string|max:255',
            'five' => 'required|string|max:255',
            'six' => 'required|string|max:255',
            'private' => 'required|boolean',
            'selected_image_alt' => 'required|string',
            'selected_color_image_alt' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures', 'public');
            $validatedData['picture'] = $picturePath;
        }

        UserText::updateOrCreate(
            ['user_id' => Auth::id()],
            $validatedData
        );

        return $this->generateHtml();
    }

    public function generateHtml()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $userText = UserText::where('user_id', Auth::id())->latest()->first();
    
        if (!$userText) {
            return redirect()->route('create-portfolio')->with('error', 'No text found for the user.');
        }
    
        $data = [
            'title' => $userText->title,
            'subtitle' => $userText->subtitle,
            'text' => $userText->text,
            'one' => $userText->one,
            'two' => $userText->two,
            'three' => $userText->three,
            'four' => $userText->four,
            'five' => $userText->five,
            'six' => $userText->six,
            'private' => $userText->private,
            'selected_image_alt' => $userText->selected_image_alt,
            'selected_color_image_alt' => $userText->selected_color_image_alt,
            'fileName' => Auth::user()->name . '-' . time() . '-' . ($userText->private ? 'private' : 'public') . '.html',
            'name' => Auth::user()->name,
            'picture' => $userText->picture
        ];
    
        $templateName = $userText->selected_image_alt;
    
        $htmlContent = View::make($templateName, $data)->render();
    
        File::put(public_path($data['fileName']), $htmlContent);
    
        return redirect('/' . $data['fileName'])->with('success', 'Portfolio HTML file generated successfully.');
    }
}