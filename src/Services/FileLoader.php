<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileLoader
{

    function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    function registerFile($file, $directory){
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = $file->guessExtension();
        $fileSlug = $this->slugger->slug($filename);
        $fileUID = $fileSlug.'-'.uniqid().'.'.$ext;

        try {
            $file->move($directory, $fileUID);
        } catch (FileException $e) {
            throw new FileException($e->getMessage());
        }

        return $directory . $fileUID;
    }

}