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
}