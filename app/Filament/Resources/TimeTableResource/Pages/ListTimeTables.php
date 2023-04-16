<?php

namespace App\Filament\Resources\TimeTableResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\TimeTableResource;

class ListTimeTables extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = TimeTableResource::class;
}
