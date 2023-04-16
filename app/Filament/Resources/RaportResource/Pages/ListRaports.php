<?php

namespace App\Filament\Resources\RaportResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\RaportResource;
use App\Filament\Traits\HasDescendingOrder;

class ListRaports extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = RaportResource::class;
}
