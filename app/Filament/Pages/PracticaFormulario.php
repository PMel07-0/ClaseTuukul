<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;

class PracticaFormulario extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.pages.practica-formulario';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Miriam Doyel Lozano Matus')

                ->schema([

                    TextInput::make('nombre')
                        ->label('Nombre del proyecto')
                        ->required(),

                    Select::make('Temas')
                        ->options([
                            'tecno' => 'Tecnología',
                            'edu' => 'Educación',
                            'salud' => 'Salud',
                            'medAmb' => 'Medio ambiente',
                            'entre' => 'Entretenimiento',
                        ]),

                ]),

                    Radio::make('Prioridad')
                        ->options([
                            'baja' => 'Baja',
                            'media' => 'Media',
                            'alta' => 'Alta'
                        ]),

                    Toggle::make('activo')
                        ->label('Proyecto Activo')
                        ->default(true),

                    DatePicker::make('fecha_entrega')
                        ->label('Fecha de Entrega')
                        ->required(),

            ])
                ->statePath('data');
    }

    public function guardar(): void
    {
        $datos = $this->form->getState();
    }
}
