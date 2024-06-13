<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class HtmlPreviewController extends Controller
{
    public function show($file)
    {
        $filePath = public_path($file);

        if (!file_exists($filePath)) {
            abort(404);
        }

        $htmlContent = file_get_contents($filePath);
        $crawler = new Crawler($htmlContent);

        $containerHtml = '';
        $styles = '';

        // Extract container div and styles
        $container = $crawler->filter('.container');
        if ($container->count() > 0) {
            // Get the outer HTML of the first matched element
            $containerHtml = $container->first()->outerHtml();
        }

        // Extract styles
        $styleElements = $crawler->filter('link[rel="stylesheet"], style');
        foreach ($styleElements as $styleElement) {
            // Get the outer HTML of each style element
            $styles .= $this->getOuterHtml($styleElement);
        }

        return view('html-preview', compact('containerHtml', 'styles'));
    }

    private function getOuterHtml($node)
    {
        // If it's a DOMNode, convert it to HTML
        if ($node instanceof \DOMNode) {
            $doc = new \DOMDocument();
            $doc->appendChild($doc->importNode($node, true));
            return $doc->saveHTML();
        }
        // If it's not a DOMNode, just return its string representation
        return (string) $node;
    }
}