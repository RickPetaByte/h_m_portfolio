<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function showPortfolio($layout)
    {
        $portfolio = Portfolio::where('selected_image_alt', $layout . '.blade.php')->firstOrFail();
        return view($layout, compact('portfolio'));
    }

    public function show()
    {
        return view('create-portfolio');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:18',
            'subtitle' => 'required|string|max:18',
            'one' => 'nullable|string|max:20',
            'two' => 'nullable|string|max:20',
            'three' => 'nullable|string|max:20',
            'four' => 'nullable|string|max:20',
            'five' => 'nullable|string|max:20',
            'six' => 'nullable|string|max:20',
            'about' => 'nullable|string|max:130',
            'private' => 'required|boolean',
            'selected_image_alt' => 'required|string',
            'selected_color_image_alt' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $portfolio = new Portfolio([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'one' => $request->input('one'),
            'two' => $request->input('two'),
            'three' => $request->input('three'),
            'four' => $request->input('four'),
            'five' => $request->input('five'),
            'six' => $request->input('six'),
            'about' => $request->input('about'),
            'private' => $request->input('private'),
            'selected_image_alt' => $request->input('selected_image_alt'),
            'selected_color_image_alt' => $request->input('selected_color_image_alt'),
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('storage/img/portfolio-pictures', 'public');
            $portfolio->picture = $path;
        }

        $portfolio->save();

        return response()->json(['success' => true, 'message' => 'Portfolio created successfully', 'layout' => $portfolio->selected_image_alt]);
    }
=======
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

>>>>>>> debcda734c4dfb4f754000f6edbded4635ba9936
}
