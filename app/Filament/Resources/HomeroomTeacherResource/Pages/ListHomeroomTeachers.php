<?php

namespace App\Filament\Resources\HomeroomTeacherResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\HomeroomTeacherResource;

class ListHomeroomTeachers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = HomeroomTeacherResource::class;
}
