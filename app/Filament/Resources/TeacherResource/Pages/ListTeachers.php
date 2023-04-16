<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\TeacherResource;

class ListTeachers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = TeacherResource::class;
}
