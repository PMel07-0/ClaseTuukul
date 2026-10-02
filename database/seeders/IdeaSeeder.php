<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Idea;

class IdeaSeeder extends Seeder
{

    public function run(): void
    {
        
    
        Idea::create([
            'titulo' => 'Aplicación para organizar citas veterinarias',
            'descripcion' => 'Sistema para registrar y organizar citas de mascotas.',
            'estado' => 'registrada',
            'autor' => 'Jose',
            'categoria_id' => 1
        ]);
 
        Idea::create([
            'titulo' => 'Plataforma para cursos en línea',
            'descripcion' => 'Sistema para ofrecer cursos y materiales educativos.',
            'estado' => 'en revisión',
            'autor' => 'Pedro',
            'categoria_id' => 2
        ]);

        //Ideas nuevas de tarea
        Idea::create([
            'titulo' => 'Aplicación para cuidado de animales',
            'descripcion' => 'Sistema para ofrecer apoyo a distancia, cuidados y listado de veterinarias cercanas.',
            'estado' => 'registrada',
            'autor' => 'Laura',
            'categoria_id' => 3
        ]);

        Idea::create([
            'titulo' => 'Página web para consultas de tecnologia',
            'descripcion' => 'Sistema para encontrar dispositivos de calidad.',
            'estado' => 'en revisión',
            'autor' => 'Luna',
            'categoria_id' => 4
        ]);
    }
}