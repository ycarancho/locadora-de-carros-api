<?php

namespace App\Api\Utils\ArchiveTratament;

use App\Api\Utils\ArchiveTratament\ArchiveContracts\IArchive;

class ArchiveTratament
{
    public function saveFile(IArchive $archive, $file)
    {
        return $archive->save($file);
    }

    public function deleteFile(IArchive $archive, $file)
    {
        return $archive->delete($file);
    }
}
