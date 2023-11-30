<?php

namespace App\Api\Utils\ArchiveTratament;

use App\Api\Utils\ArchiveTratament\ArchiveContracts\IArchive;

class ArchiveTratament
{
    public function saveFile(IArchive $archive, $file, $path)
    {
        return $archive->save($file, $path);
    }

    public function deleteFile(IArchive $archive, $file)
    {
        return $archive->delete($file);
    }
}
