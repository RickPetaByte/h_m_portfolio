<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class PortfolioController extends Controller
{
    public function updateHtml(Request $request, $fileName)
    {
        $request->validate([
            'htmlTitle' => 'required|string',
            'htmlSubTitle' => 'required|string',
            'htmlContent' => 'required|string',
            'htmlOne' => 'required|string',
            'htmlTwo' => 'required|string',
            'htmlThree' => 'required|string',
            'htmlFour' => 'required|string',
            'htmlFive' => 'required|string',
            'htmlSix' => 'required|string',
            'htmlTemplate' => 'required|string',
            'htmlPicture' => 'required|string',
            'htmlLayoutUrl' => 'required|string',
        ]);
    
        $filePath = public_path($fileName);
        $newTitle = $request->input('htmlTitle');
        $newSubTitle = $request->input('htmlSubTitle');
        $newContent = $request->input('htmlContent');
        $newOne = $request->input('htmlOne');
        $newTwo = $request->input('htmlTwo');
        $newThree = $request->input('htmlThree');
        $newFour = $request->input('htmlFour');
        $newFive = $request->input('htmlFive');
        $newSix = $request->input('htmlSix');
    
        $user = Auth::user();
        $name = $user->name; 
    
        $templateFile = $request->input('htmlTemplate'); 
    
        if (view()->exists($templateFile)) {
            $html = View::make($templateFile, [
                'title' => $newTitle,
                'subtitle' => $newSubTitle,
                'text' => $newContent,
                'one' => $newOne,
                'two' => $newTwo,
                'three' => $newThree,
                'four' => $newFour,
                'five' => $newFive,
                'six' => $newSix,
                'selected_image_alt' => $request->input('htmlTemplate'),
                'picture' => $request->input('htmlPicture'),
                'selected_color_image_alt' => $request->input('htmlLayoutUrl'),
                'fileName' => $fileName,
                'name' => $name,
            ])->render();
    
            File::put($filePath, $html);
    
            $userText = UserText::where('user_id', Auth::id())->first();
            if ($userText) {
                $userText->update([
                    'title' => $newTitle,
                    'subtitle' => $newSubTitle,
                    'text' => $newContent,
                    'one' => $newOne,
                    'two' => $newTwo,
                    'three' => $newThree,
                    'four' => $newFour,
                    'five' => $newFive,
                    'six' => $newSix,
                ]);
            } else {
                UserText::create([
                    'user_id' => Auth::id(),
                    'title' => $newTitle,
                    'subtitle' => $newSubTitle,
                    'text' => $newContent,
                    'one' => $newOne,
                    'two' => $newTwo,
                    'three' => $newThree,
                    'four' => $newFour,
                    'five' => $newFive,
                    'six' => $newSix,
                ]);
            }
    
            return redirect('/' . $fileName)->with('success', 'HTML file and database updated successfully.');
        } else {
            return back()->withInput()->withErrors(['htmlTemplate' => 'Template file not found.']);
        }
    }
    
    public function generateHtml($title, $subtitle, $text, $one, $two, $three, $four, $five, $six)
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
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'four' => $four,
            'five' => $five,
            'six' => $six,
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
            'one' => $one,
            'two' => $two,
            'three' => $three,
            'four' => $four,
            'five' => $five,
            'six' => $six,
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
            File::delete($filePath);
    
            $fileNameParts = pathinfo($fileName);
            $fileBaseName = $fileNameParts['filename'];
    
            $userText = UserText::where('user_id', Auth::id())
                                ->where('title', $fileBaseName)
                                ->first();
    
            if ($userText) {
                $userText->delete();
            }
    
            return redirect('/dashboard')->with('message', 'Deleted successfully!');
        } else {
            return back()->withErrors(['message' => 'File not found.']);
        }
    }
}