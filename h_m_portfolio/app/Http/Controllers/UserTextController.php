<?php

namespace App\Http\Controllers;

use App\Models\UserText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class UserTextController extends Controller
{
    public function showForm()
    {
        return view('edit-portfolio');
    }

    public function storeText(Request $request) 
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            //text komt nog
        ]);

        $userText = UserText::updateOrCreate(
            ['user_id' => Auth::id()],
            ['title' => $validatedData['title'] /*text komt nog */ ]
        );

        $UserTextController = new UserTextController();

        return $UserTextController->generate($validatedData['title'], /*text komg nog*/);
    }

    public function generateHtml()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userText = UserText::where('user_id', Auth::id())->latest()->first();

        if (!$userText) {
            return redirect()->route('edit-portfolio')->with('error', 'No text found for the user.');
        }

        $data = [
            'text' => $userText->text,
        ];

        $htmlContent = View::make('dynamic-template', $data)->render();

        $fileName = Auth::user()->name . '-' . time() . '.html';
        $filePath = public_path($fileName);

        File::put($filePath, $htmlContent);

        return response()->json([
            'message' => 'File created successfully',
            'file_path' => $filePath,
        ]);
    }

    public function index(Request $request)
    {
        // Haal de geselecteerde afbeeldinggegevens op uit het request
        $template = $request->input('template');
        $color = $request->input('color');
        
        // Sla de geselecteerde afbeeldinggegevens op in de sessie
        $request->session()->put('selectedImage', ['template' => $template, 'color' => $color]);
        
        // Stuur de gebruiker door naar de volgende pagina
        return view('edit-portfolio');
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
