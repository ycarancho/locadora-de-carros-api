<?php

namespace App\Api\Utils\ArchiveTratament;

use App\Api\Utils\ArchiveTratament\ArchiveContracts\IArchive;
use Illuminate\Support\Facades\Storage;

class SaveArchiveLocal implements IArchive
{
    public function save($file)
    {
        return $this->saveLocalStorage($file);
    }

    public function saveLocalStorage($file){
       $fileName = Storage::disk('public')->put('imagens/marcas', file_get_contents($file), 'public');
       $filePath = Storage::disk('public')->url($fileName);

       return $filePath;
    }
}
