<?php

namespace App\Api\Utils\ArchiveTratament\ArchiveContracts;

interface IArchive
{
    public function save($file);
    public function delete($file);
}
