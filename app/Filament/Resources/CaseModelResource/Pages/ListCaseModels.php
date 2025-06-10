<?php

namespace App\Filament\Resources\CaseModelResource\Pages;

use App\Filament\Resources\CaseModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaseModels extends ListRecords
{
    protected static string $resource = CaseModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
