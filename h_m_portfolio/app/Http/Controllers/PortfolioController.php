<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function show()
    {
        return view('create-portfolio');
    }

    public function store(Request $request)
    {
        // Validatie van de invoer
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

        // Maak een nieuwe portfolio aan en vul de velden
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

        // Verwerk de afbeelding indien aanwezig
        if ($request->hasFile('picture')) {
            // Sla de afbeelding op in de map 'public/img/portfolio-pictures'
            $path = $request->file('picture')->store('img/portfolio-pictures', 'public');
            // Sla het pad van de afbeelding op in de database
            $portfolio->picture = $path;
        }

        // Sla het portfolio op in de database
        $portfolio->save();

        // Redirect naar de gewenste route met een succesbericht
        return redirect()->route('portfolio.show')->with('success', 'Portfolio created successfully');
    }
}