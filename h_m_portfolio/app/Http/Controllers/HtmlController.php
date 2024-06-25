<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class HtmlController extends Controller
{
    // Retrieve all public HTML files from the public directory, clean them, and return as an array.
    public function getHtmlFiles()
    {
        // Get all files in the public directory
        $files = File::files(public_path());

        // Filter HTML files
        $htmlFiles = array_filter($files, function ($file) {
            return $file->getExtension() == 'html';
        });

        $cleanedFiles = [];

        // Iterate through each HTML file
        foreach ($htmlFiles as $file) {
            $fileName = $file->getFilename();

            // Determine visibility (public or private) from file name
            $visibility = $this->getFileVisibilityFromFileName($fileName);

            // Process only public files
            if ($visibility === 'public') {
                // Read file content
                $content = file_get_contents($file->getPathname());

                // Clean HTML content
                $cleanedContent = $this->removeScriptTags($content);
                $cleanedContent = $this->removeNavTag($cleanedContent);
                $cleanedContent = $this->removeSidebarElements($cleanedContent);

                // Store cleaned content with file name
                $cleanedFiles[$fileName] = $cleanedContent;
            }
        }

        return $cleanedFiles;
    }
    
    // Extract file visibility (public or private) from the file name.
    private function getFileVisibilityFromFileName($fileName)
    {
        // Match and return visibility from file name pattern
        if (preg_match('/-(public|private)\.html$/', $fileName, $matches)) {
            return $matches[1];
        }
        // Default to private if visibility not specified
        return 'private';
    }
    
    // Remove <script> tags from HTML content, excluding specific classed scripts.
    private function removeScriptTags($content)
    {
        return preg_replace('/<script\b(?![^>]*?\bclass="sendThisScriptToHomePage")[^>]*>[\s\S]*?<\/script>/i', '', $content);
    }

    // Remove <nav> tags from HTML content.
    private function removeNavTag($content)
    {
        return preg_replace('/<nav\b[^>]*>[\s\S]*?<\/nav>/i', '', $content);
    }

    // Remove specific sidebar elements from HTML content.
    private function removeSidebarElements($content)
    {
        // Remove <div> element with id="sidebarHomepage"
        $content = preg_replace('/<div\b[^>]*\bid="sidebarHomepage"[^>]*>[\s\S]*?<\/div>/i', '', $content);
        
        // Remove <button> element with id="sidebar-toggle"
        $content = preg_replace('/<button\b[^>]*\bid="sidebar-toggle"[^>]*>[\s\S]*?<\/button>/i', '', $content);
        
        return $content;
    }
}