<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class PortfolioController extends Controller
{
    public function deletePortfolio(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
        ]);

        $fileName = $request->input('file_name');
        $filePath = public_path($fileName);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect('/dashboard')->with('message', 'Deleted successfully!');
        }
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
                'text' => $newContent,
            ]);
        }

        return redirect('/' . $fileName)->with('success', 'HTML file and database updated successfully.');
    }

    public function showEditHtml($fileName)
    {
        $filePath = public_path($fileName);
        $htmlContent = File::get($filePath);

        return view('edit-html', compact('htmlContent', 'fileName'));
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

        File::put($filePath, $htmlContent);

        return redirect('/' . $fileName)->with('success', 'Portfolio HTML file generated successfully.');
    }



}