<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a unique file name
        $fileName = Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();

        // Store the image in the 'public/storage/pictures' directory
        $path = $request->file('image')->storeAs('public/pictures', $fileName);

        // Return the path of the uploaded image
        return response()->json(['path' => Storage::url($path)]);
    }
}