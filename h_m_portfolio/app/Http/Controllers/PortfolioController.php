<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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

        ];

        $htmlContent = View::make('dynamic-template', $data)->render();
        $filePath = public_path($fileName);

        File::put($filePath, $htmlContent);
        
        //Redirect naar de generated html file
        return redirect('/' . $fileName)->with('success', 'Portfolio HTML file generated successfully');
    }

    public function showEditHtml($fileName) 
    {
        $filePath = public_path($fileName);
        $htmlContent = File::get($filePath);

        return view('edit-html', compact('htmlContent', 'fileName'));
    }

    public function updateHtml(Request $request, $fileName)
    {
        $request->validate([
            'htmlTitle' => 'required|string',
            // 'htmlContent' => 'required|string'
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
        $userText = Portfolio::where('user_id', Auth::id())->first();
        $userText->update(['title' => $newTitle, /*content komt nog*/ ]);

        return redirect('/' . $fileName)->with('success', 'HTML file updated successfully');
    }

    public function downloadPDF($fileName)
    {
        // Pad naar het gegenereerde HTML-bestand
        $htmlFilePath = public_path($fileName);

        // Bestandsnaam voor het resulterende PDF-bestand
        $pdfFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';

        // Pad naar de locatie waar het PDF-bestand wordt opgeslagen
        $pdfFilePath = public_path($pdfFileName);

        // Haal de basisnaam van het commando op uit de .env bestand
        $wkhtmltopdfBinary = 'wkhtmltopdf';

        // Haal het pad naar de map op uit de .env bestand
        $wkhtmltopdfPath = env('WKHTMLTOPDF_PATH', 'C:/wkhtmltopdf/bin/wkhtmltopdf.exe'); // Standaard pad, wijzig indien nodig

        // Controleer of de paden correct zijn
        if (!file_exists($wkhtmltopdfPath)) {
            throw new \RuntimeException("wkhtmltopdf binary not found at $wkhtmltopdfPath");
        }
        if (!file_exists($htmlFilePath)) {
            throw new \RuntimeException("HTML file not found at $htmlFilePath");
        }

        // Combineer het pad met de basisnaam om het volledige pad naar het uitvoerbare bestand te vormen
        $wkhtmltopdfFullPath = $wkhtmltopdfPath . DIRECTORY_SEPARATOR . $wkhtmltopdfBinary;

        // Bouw het commando op als een array
        $command = [
            $wkhtmltopdfBinary,
            $htmlFilePath,
            $pdfFilePath
        ];

        // Uitvoeren van het commando
        $process = new Process($command);
        $process->run();

        // Controleren op fouten
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Stuur het PDF-bestand naar de browser
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }

}
