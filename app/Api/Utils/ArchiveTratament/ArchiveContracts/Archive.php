<?php

namespace App\Api\Utils\ArchiveTratament\ArchiveContracts;

abstract class Archive {
    abstract public function save($file);
}