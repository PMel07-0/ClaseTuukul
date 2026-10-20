<?php

namespace App\Helpers;

class EstadoIdea {
    public static function opciones(): array{
        return[
            'registrada' => 'Registrada',
            'en revisión' => 'En Revisión',
            'aprobada' => 'Aprobada',
            'rechazada' => 'Rechazada',
        ];
    }
}