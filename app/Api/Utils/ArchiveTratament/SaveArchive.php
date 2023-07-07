<?php

namespace App\Api\Utils\ArchiveTratament;

use App\Api\Utils\ArchiveTratament\ArchiveContracts\IArchive;

class SaveArchive
{
    public function saveFile(IArchive $archive, $file)
    {
       return $archive->save($file);
    }
}
