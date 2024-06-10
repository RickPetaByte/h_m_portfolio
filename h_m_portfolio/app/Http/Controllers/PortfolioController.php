<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
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
}
