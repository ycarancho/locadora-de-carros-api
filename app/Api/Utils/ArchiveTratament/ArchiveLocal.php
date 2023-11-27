<?php

namespace App\Api\Utils\ArchiveTratament;

use App\Api\Utils\ArchiveTratament\ArchiveContracts\IArchive;
use Illuminate\Support\Facades\Storage;

class ArchiveLocal implements IArchive
{
    public function save($file)
    {
        return $this->saveLocalStorage($file);
    }

    public function delete($file)
    {
        return $this->deleteLocalStorage($file);
    }

    public function saveLocalStorage($file)
    {
        $fileName = Storage::disk('public')->put('imagens/marcas', $file, 'public');
        $filePath = Storage::disk('public')->url($fileName);

        return $filePath;
    }

    public function deleteLocalStorage($file)
    {
        $urn = str_replace('http://localhost:8000/storage/', '', $file);
        if (Storage::disk('public')->exists($urn)) {
            return Storage::disk('public')->delete($urn);
        }
    }
}