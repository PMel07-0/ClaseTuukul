<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Idea;
use App\Models\Categoria;

class CategoriasGrafica extends ChartWidget
{
    protected static ?int $sort=3;
    protected ?string $heading = 'Categorías de las ideas';

    protected function getData(): array
    {
        $tecnologia = Idea::whereHas('categoria', function ($query) {
            $query->where('nombre', 'Tecnología'); })->count();
        $educacion = Idea::whereHas('categoria', function ($query) {
            $query->where('nombre', 'Educación'); })->count();
        $salud = Idea::whereHas('categoria', function ($query) {
            $query->where('nombre', 'Salud'); })->count();
        $medioAmbiente = Idea::whereHas('categoria', function ($query) {
            $query->where('nombre', 'Medio Ambiente'); })->count();
        $marketing = Idea::whereHas('categoria', function ($query) {
            $query->where('nombre', 'Marketing'); })->count();

        return [
            'datasets' => [
                [
                    'label' => 'Categorías',
                    'data' => [$tecnologia, $educacion, $salud, $medioAmbiente, $marketing],
                    'backgroundColor' => ['#C6A0D4', '#9194E2', '#8DD6E2', '#9FC7B9','#FDE8B3'],
                ],
            ],
            'labels' => ['Tecnología', 'Educación', 'Salud', 'Medio Ambiente', 'Marketing'],
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }
}
