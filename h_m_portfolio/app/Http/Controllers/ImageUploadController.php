<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    // Upload image that you select in edit portfolio page
    public function uploadImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a unique file name
        $fileName = Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
        
        // De kans dat 2 bestanden dezelfde naam krijgen is 1 op de 496,212,362,459,367,066,914,366,580,195,701,544,604,991,251,555,593,230,875,525,121,862,270,976. 

        // Store the image in the 'public/storage/pictures' directory
        $path = $request->file('image')->storeAs('public/pictures', $fileName);

        // Return the path of the uploaded image
        return response()->json(['path' => Storage::url($path)]);
    }
}