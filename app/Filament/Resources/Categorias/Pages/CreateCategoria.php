<?php

namespace App\Filament\Resources\Categorias\Pages;

use App\Filament\Resources\Categorias\CategoriaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;
    //elimina el botón de crear otro registro
    protected static bool $canCreateAnother = false;

    //
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    //envía un mensaje que confirma que el 
    protected function getCreatedNotificationTitle(): ?string
    {
        return '¡Categoría Registrada!';
    }

}
