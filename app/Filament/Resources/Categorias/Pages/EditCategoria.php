<?php

namespace App\Filament\Resources\Categorias\Pages;

use App\Filament\Resources\Categorias\CategoriaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    //
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    //envía un mensaje que confirma que el 
    protected function getSavedNotificationTitle(): ?string
    {
        return '¡Categoría Actualizada Exitosamente!';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->hidden(fn($record) => ideas() ->withTrashed -> exists()),
        ];
    }
}
