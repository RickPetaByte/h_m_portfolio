<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function showGeneratorPage()
    {
        $portfolios = Portfolio::all();
        return view('portfolio-generator', compact('portfolios'));
    }

    public function generatePortfolio(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Niet geautoriseerd'], 401);
        }

        $user = Auth::user();

        $request->validate([
            'portfolio_id' => 'required|exists:portfolios,id',
        ]);

        $portfolio = Portfolio::find($request->input('portfolio_id'));

        $data = [
            'title' => $portfolio->title,
            'content' => $portfolio->content,
            'subtitle' => $portfolio->subtitle,
        ];

        $htmlContent = View::make('dynamic-template', $data)->render();

        $fileName = $user->name . '-' . time() . '.html';
        $filePath = public_path($fileName);

        File::put($filePath, $htmlContent);

        return response()->json([
            'message' => 'Bestand succesvol aangemaakt',
            'file_path' => $filePath
        ]);
    }




    public function updatePortfolio(Request $request)
    {
        $data = $request->validate([
            'editableTitle' => 'required|string|max:255',
            'editableSubtitle' => 'nullable|string|max:255',
            'editableText' => 'nullable|string',
            'editableOne' => 'nullable|string|max:255',
            'editableTwo' => 'nullable|string|max:255',
            'editableThree' => 'nullable|string|max:255',
            'editableFour' => 'nullable|string|max:255',
            'editableFive' => 'nullable|string|max:255',
            'editableSix' => 'nullable|string|max:255',
        ]);

        $userText = UserText::where('user_id', Auth::id())->first();
        if ($userText) {
            $userText->update($data);
        } else {
            UserText::create(array_merge($data, ['user_id' => Auth::id()]));
        }

        return response()->json(['success' => true]);
    }




    public function updateHtml(Request $request, $fileName)
    {
        $request->validate([
            'htmlTitle' => 'required|string',
            'htmlContent' => 'required|string',
        ]);

        $filePath = public_path($fileName);
        $newTitle = $request->input('htmlTitle');
        $newContent = $request->input('htmlContent');

        File::put($filePath, View::make('dynamic-template', [
            'title' => $newTitle,
            'text' => $newContent,
            'fileName' => $fileName,
        ])->render());

        $userText = UserText::where('user_id', Auth::id())->first();
        if ($userText) {
            $userText->update(['title' => $newTitle, 'text' => $newContent]);
        } else {
            // Create a new record if not exists
            UserText::create([
                'user_id' => Auth::id(),
                'title' => $newTitle,
                'subtitle' => $userText->subtitle,
                'text' => $newContent,
                'one' => $userText->one,
                'two' => $userText->two,
                'three' => $userText->three,
                'four' => $userText->four,
                'five' => $userText->five,
                'six' => $userText->six,
                'fileName' => $fileName
            ]);
        }

        return redirect('/' . $fileName)->with('success', 'HTML file and database updated successfully.');
    }

    public function update(Request $request, $fileName)
    {
        $validator = Validator::make($request->all(), [
            'htmlTitle' => 'required|string|max:255',
            'htmlSubtitle' => 'nullable|string|max:255',
            'htmlText' => 'nullable|string',
            'htmlOne' => 'nullable|string|max:255',
            'htmlTwo' => 'nullable|string|max:255',
            'htmlThree' => 'nullable|string|max:255',
            'htmlFour' => 'nullable|string|max:255',
            'htmlFive' => 'nullable|string|max:255',
            'htmlSix' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $portfolio = Portfolio::where('file_name', $fileName)->firstOrFail();
    
        $portfolio->update($request->only([
            'htmlTitle', 
            'htmlSubtitle', 
            'htmlText', 
            'htmlOne', 
            'htmlTwo', 
            'htmlThree', 
            'htmlFour', 
            'htmlFive', 
            'htmlSix'
        ]));
    
        return redirect()->back();
    }

    public function generateHtml($title, $text) 
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $fileName = Auth::user()->name . '-' . time() . '.html';
        $filePath = public_path($fileName);

        $data = [
            'title' => $title,
            'text' => $text,
            'fileName' => $fileName,
        ];

        $htmlContent = View::make('dynamic-template', $data)->render();
        $filePath = public_path($fileName);

        File::put($filePath, $htmlContent);

        return redirect('/' . $fileName);
    }

    public function showEditHtml($fileName)
    {
        $filePath = public_path($fileName);
        $htmlContent = File::get($filePath);

        return view('edit-html', compact('htmlContent', 'fileName'));
    }
}