<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class PortfolioController extends Controller
{
    public function showGeneratorPage()
    {
        // Haal alle portfolio data op
        $portfolios = Portfolio::all();
        return view('portfolio-generator', compact('portfolios'));
    }
    
    public function generatePortfolio(Request $request) 
    {
        // Zorg ervoor dat de gebruiker is ingeglogd
        if(!Auth::check()) {
            return response()->json(['message' => 'Niet geautoriseerd'], 401);
        }

        // Haal de ingelogde user op
        $user = Auth::user();

        //Valideer portfolio_id
        $request->validate([
            'portfolio_id' => 'required|exists:portfolios,id',
        ]);

        $portfolio = Portfolio::find($request->input('portfolio_id'));

        //Data die je aan de view wilt doorgeven
        $data = [
            'title' => $portfolio->title, //voor nu alleen title
        ];

        //Render de view
        $htmlContent = View::make('dynamic-template', $data)->render();

        //Definieer het bestandpad en naam met de gebruikersnaam
        $fileName = $user->name . '-' . time() . '.html';
        $filePath = public_path($fileName);

        //HTML-inhoud naar het bestand
        File::put($filePath, $htmlContent);

        return response()->json([
            'message' => 'Bestand succesvol aangemaakt',
            'file_path' => $filePath
        ]);
    }

    public function updateHtml(Request $request, $fileName)
    {
        $request->validate([
            'htmlTitle' => 'required|string',
            'htmlContent' => 'required|string'
        ]);

        $filePath = public_path($fileName);
        $newTitle = $request->input('htmlTitle');
        //content komt nog

        //Update de content
        File::put($filePath, View::make('dynamic-template', [
            'title' => $newTitle,
            //content komt nog
        ])->render());

        //Update de title
        $userText = UserText::where('user_id', Auth::id()->first());
        $userText->update(['title' => $newTitle, /*content komt nog*/ ]);

        return redirect('/' . $fileName)->with('success', 'HTML file updated successfully');
    }

    public function generateHtml($title, $text) //parameter layout weggehaald
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        $fileName = Auth::user()->name . '-' . time() . '.html';
        $filePath = public_path($fileName);

        $data = [
            'title' => $title,
            //text komt nog
            'fileName' => $fileName,

        ]

        $htmlContent = View::make('dynamic-template', $data)->render();
        $filePath = public_path($fileName);

        File::put($filePath, $htmlContent);

        return redirect('/' . $fileName)->with('success', 'Portfolio HTML file generated successfully');
    }

    public function showEditHtml($fileName) 
    {
        $filePath = public_path($fileName);
        $htmlContent = File::get($filePath);

        return view('edit-html', compact('htmlContent', 'fileName'));
    }

    public function downloadPDF($fileName) 
    {
        // Pad naar het gegenereerde HTML-bestand
        $htmlFilePath = public_path($fileName);

        // Bestandsnaam voor het resulterende PDF-bestand
        $pdfFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';

        // Pad naar de locatie waar het PDF-bestand wordt opgeslagen
        $pdfFilePath = public_path($pdfFileName);

        // Gebruik het volledige pad naar wkhtmltopdf
        $wkhtmltopdfPath = 'C:/wkhtmltopdf/bin/wkhtmltopdf.exe';

        // Controleer of de paden correct zijn
        if (!file_exists($wkhtmltopdfPath)) {
            throw new \RuntimeException("wkhtmltopdf binary not found at $wkhtmltopdfPath");
        }
        if (!file_exists($htmlFilePath)) {
            throw new \RuntimeException("HTML file not found at $htmlFilePath");
        }

        // Bouw het commando op
        $command = escapeshellcmd("$wkhtmltopdfPath $htmlFilePath $pdfFilePath");

        // Log het volledige commando voor foutopsporing
        Log::info('Executing command: ' . $command);

        // Uitvoeren van het commando
        exec($command, $output, $returnVar);

        // Log de output en de return value
        Log::info('Command output: ' . implode("\n", $output));
        Log::info('Command return value: ' . $returnVar);

        // Probeer het PDF-bestand te downloaden, ongeacht de uitkomst van het commando
        try {
            return response()->download($pdfFilePath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            // Log de fout en geef een gebruikersvriendelijke foutmelding
            Log::error('Failed to download PDF: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate or download PDF.'], 500);
        }
    }

}
