<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Idea;
use App\Models\Categoria;

class IdeasGrafica extends ChartWidget
{
    protected static ?int $sort=2;
    protected ?string $heading = 'Estado de las Ideas';

    protected function getData(): array
    {

        $registradas = Idea::where('estado', 'registrada') -> count();
        $revision = Idea::where('estado', 'en revisión') -> count();
        $aprobadas = Idea::where('estado', 'aprobada') -> count();
        $rechazadas = Idea::where('estado', 'rechazada') -> count();

        return [ 
            'datasets' => [ 
                [ 
                    'label' => 'Estados', 
                    'data' => [$registradas, $revision, $aprobadas, $rechazadas], 
                    'backgroundColor' => '#AF8FFA', 
                ], 
            ], 
            'labels' => ['Registrada','En revisión','Aprobada', 'Rechazada'], 
        ]; 

    }

    protected function getType(): string
    {
        return 'bar';
    }
}
