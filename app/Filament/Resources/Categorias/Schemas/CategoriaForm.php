<?php

namespace App\Filament\Resources\Categorias\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CategoriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre') //se asocia directamente a la tabla
                    //->password()
                    //->email()
                    ->label('Nombre de Categoría')
                    ->helperText('Ingresa el nombre de la categoría') //ayuda a decir al usuario lo que se tiene que poner
                    ->placeholder('Ej. Categoría') 
                    //->disabled(1 != 1) -> modulo para desabilitar un campo
                    //->inlineLabel() -> airve para poner todo en una sola linea
                    ->required(),
                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->helperText('Ingresa la descripción de la categoría')
                    ->required() //que es requerido / obligatorio
                    ->columnSpanFull(),
            ]);
    }
}
