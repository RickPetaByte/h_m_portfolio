<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class HtmlController extends Controller
{
    public function getHtmlFiles()
    {
        $files = File::files(public_path());
        $htmlFiles = array_filter($files, function ($file) {
            return $file->getExtension() == 'html';
        });
    
        $cleanedFiles = [];
    
        foreach ($htmlFiles as $file) {
            $fileName = $file->getFilename();
    
            // Extract visibility from the filename
            $visibility = $this->getFileVisibilityFromFileName($fileName);
    
            if ($visibility === 'public') {
                $content = file_get_contents($file->getPathname());
                $cleanedContent = $this->removeNavTag($content);
                $cleanedContent = $this->removeDeleteButton($cleanedContent);
                $cleanedFiles[$fileName] = $cleanedContent;
            }
            // If visibility is 'private', skip processing this file
        }
    
        return $cleanedFiles;
    }
    
    private function getFileVisibilityFromFileName($fileName)
    {
        // Extract visibility ('public' or 'private') from the filename
        if (preg_match('/-(public|private)\.html$/', $fileName, $matches)) {
            return $matches[1];
        }
        // Default to 'private' if no visibility marker is found in the filename
        return 'private';
    }
    
    private function removeNavTag($content)
    {
        // Remove the <nav> tag and its contents
        return preg_replace('/<nav\b[^>]*>[\s\S]*?<\/nav>/i', '', $content);
    }
    
    private function removeDeleteButton($content)
    {
        // Remove the button with id "deleteButton" and its contents
        return preg_replace('/<button\b[^>]* id="deleteButton"[^>]*>[\s\S]*?<\/button>/i', '', $content);
    }
}