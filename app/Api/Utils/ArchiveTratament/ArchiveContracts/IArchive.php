<?php

namespace App\Api\Utils\ArchiveTratament\ArchiveContracts;

interface IArchive
{
    public function save($file, $path);
    public function delete($file);
}
