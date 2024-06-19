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
    
            $visibility = $this->getFileVisibilityFromFileName($fileName);
    
            if ($visibility === 'public') {
                $content = file_get_contents($file->getPathname());
                
                $cleanedContent = $this->removeScriptTags($content);
                
                $cleanedContent = $this->removeNavTag($cleanedContent);
                $cleanedContent = $this->removeDeleteButton($cleanedContent);
                
                $cleanedFiles[$fileName] = $cleanedContent;
            }
        }
    
        return $cleanedFiles;
    }
    
    private function getFileVisibilityFromFileName($fileName)
    {
        if (preg_match('/-(public|private)\.html$/', $fileName, $matches)) {
            return $matches[1];
        }
        return 'private';
    }
    
    private function removeScriptTags($content)
    {
        return preg_replace('/<script\b(?![^>]*?\bclass="sendThisScriptToHomePage")[^>]*>[\s\S]*?<\/script>/i', '', $content);
    }
    
    private function removeNavTag($content)
    {
        return preg_replace('/<nav\b[^>]*>[\s\S]*?<\/nav>/i', '', $content);
    }
    
    private function removeDeleteButton($content)
    {
        return preg_replace('/<button\b[^>]* id="deleteButton"[^>]*>[\s\S]*?<\/button>/i', '', $content);
    }
}