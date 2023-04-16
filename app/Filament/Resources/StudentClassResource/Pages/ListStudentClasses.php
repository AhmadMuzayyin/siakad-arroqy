<?php

namespace App\Filament\Resources\StudentClassResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\StudentClassResource;

class ListStudentClasses extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = StudentClassResource::class;
}
