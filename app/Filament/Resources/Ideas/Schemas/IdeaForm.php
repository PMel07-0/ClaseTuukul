<?php

namespace App\Filament\Resources\Ideas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Helpers\EstadoIdea;

class IdeaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título de la idea: ')
                    ->helperText('Escribe un título que sea ilustrativo y breve.')
                    ->placeHolder('Ej. Aplicación de comida')
                    ->required(),
                Textarea::make('descripcion')
                    ->label('Descripción de la idea: ')
                    ->helperText('Describe a detalle sobre lo que va a tratar tu idea')
                    ->placeHolder('Ej. Aplicación que ayudará a que las personas puedan ordenar comida desde su casa')
                    ->required()
                    ->columnSpanFull(),
                Select::make('estado')
                    ->required()
                    ->options(EstadoIdea::opciones())
                    ->default('Registrada'),
                TextInput::make('autor')
                    ->required(),
                Select::make('categoria_id')
                    ->relationship('categoria', 'nombre')
                    ->required(),
            ]);
    }
}
