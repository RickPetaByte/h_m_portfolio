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