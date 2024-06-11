<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

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

    public function deletePortfolio(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
        ]);

        $fileName = $request->input('file_name');
        $filePath = public_path($fileName);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect('/dashboard')->with('message', 'Bestand succesvol verwijderd');
        }
    }
}