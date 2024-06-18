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
            $content = file_get_contents($file->getPathname());
            $cleanedContent = $this->removeNavTag($content);
            $cleanedContent = $this->removeDeleteButton($cleanedContent);
            $cleanedFiles[$file->getFilename()] = $cleanedContent;
        }

        return $cleanedFiles;
    }

    private function removeNavTag($content)
    {
        // Verwijder de <nav> tag en de inhoud ervan
        return preg_replace('/<nav\b[^>]*>[\s\S]*?<\/nav>/i', '', $content);
    }

    private function removeDeleteButton($content)
    {
        // Verwijder de button met het id "deleteButton" en de inhoud ervan
        return preg_replace('/<button\b[^>]* id="deleteButton"[^>]*>[\s\S]*?<\/button>/i', '', $content);
    }
}