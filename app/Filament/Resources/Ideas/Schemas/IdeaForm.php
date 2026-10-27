<?php

namespace App\Filament\Resources\Ideas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema; 
use App\Helpers\EstadoIdea;
use Filament\Schemas\Components\Utilities\Get;

class IdeaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([ 
                TextInput::make('titulo')
                    ->label('Título de la idea: ')
                    ->helperText('Escribe un título que sea ilustrativo y breve.')
                    ->placeholder('Ej. Aplicación de comida')
                    ->unique()
                    ->validationMessages([
                        'unique' => 'Ya existe una idea registrada bajo este título.',
                    ])
                    ->required(),
                
                Textarea::make('descripcion')
                    ->label('Descripción de la idea: ')
                    ->helperText('Describe a detalle sobre lo que va a tratar tu idea')
                    ->placeholder('Ej. Aplicación que ayudará a que las personas puedan ordenar comida desde su casa')
                    ->required()
                    ->columnSpanFull(),
                
                TextInput::make('autor')
                    ->required(),
                
                Select::make('categoria_id')
                    ->relationship('categoria', 'nombre')
                    ->required(),
                
                Select::make('estado')
                    ->required()
                    ->options(EstadoIdea::opciones())
                    ->default('Registrada')
                    ->hiddenOn('create')
                    ->live(),
                
                Textarea::make('observacion')
                    ->label('Motivo de rechazo.')
                    ->visible(fn(Get $get) => 
                        $get('estado') === 'rechazada'
                    )
                    ->maxLength(200)
                    ->required(), 
            ]);
    }
}
