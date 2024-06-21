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


    public function deletePortfolio(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
        ]);

        $fileName = $request->input('file_name');
        $filePath = public_path($fileName);

        if (File::exists($filePath)) {
            try {
                File::delete($filePath);

                // Optionally, update the database if you have a record of the file
                $userText = UserText::where('user_id', Auth::id())->where('fileName', $fileName)->first();
                if ($userText) {
                    $userText->delete();
                }

                return redirect('/dashboard')->with('message', 'Bestand succesvol verwijderd');
            } catch (\Exception $e) {
                return redirect('/dashboard')->with('error', 'Er is een fout opgetreden bij het verwijderen van het bestand');
            }
        } else {
            return redirect('/dashboard')->with('error', 'Bestand niet gevonden');
        }
    }

}