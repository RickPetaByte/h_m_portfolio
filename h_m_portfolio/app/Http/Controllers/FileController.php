<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class FileController extends Controller
{
    public function createHtmlFile() 
    {
        //what data you want to pass to the view
        $data = [ 
            'title' => 'Portfolio',
        ];

        //Render the view with $data
        $htmlContent = View::make('dynamic-template', $data)->render();

        //Write the content to the HTML file
        $filePath = public_path('dynamic-file.html');

        //File path and name
        File::put($filePath, $htmlContent);

        return response()->json([
            'message' => 'File created successfully',
            'file_path' => $filePath
        ]);
    }
}
