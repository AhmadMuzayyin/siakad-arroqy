<?php

namespace App\Filament\Resources\LessonResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\LessonResource;
use App\Filament\Traits\HasDescendingOrder;

class ListLessons extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = LessonResource::class;
}
