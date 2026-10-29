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
            'autor' => 'Jose Lomo',
            'categoria_id' => 1
        ]);
 
        Idea::create([
            'titulo' => 'Plataforma para cursos en línea',
            'descripcion' => 'Sistema para ofrecer cursos y materiales educativos.',
            'estado' => 'en revisión',
            'autor' => 'Pedro Alvarez',
            'categoria_id' => 2
        ]);

        //Ideas nuevas de tarea
        Idea::create([
            'titulo' => 'Aplicación para cuidado de animales',
            'descripcion' => 'Sistema para ofrecer apoyo a distancia, cuidados y listado de veterinarias cercanas.',
            'estado' => 'registrada',
            'autor' => 'Laura Lerda',
            'categoria_id' => 3
        ]);

        Idea::create([
            'titulo' => 'Página web para consultas de tecnologia',
            'descripcion' => 'Sistema para encontrar dispositivos de calidad.',
            'estado' => 'en revisión',
            'autor' => 'Luna Lovegood',
            'categoria_id' => 1
        ]);

        Idea::create([
            'titulo' => 'Red social para desarrolladores',
            'descripcion' => 'Plataforma para compartir proyectos y conocimientos tecnológicos.',
            'estado' => 'registrada',
            'autor' => 'María Becerra',
            'categoria_id' => 1
        ]);

        Idea::create([
            'titulo' => 'Administrador de licencias de software',
            'descripcion' => 'Aplicación para controlar la vigencia y uso de licencias digitales.',
            'estado' => 'registrada',
            'autor' => 'Luis Loaeza',
            'categoria_id' => 1
        ]);

        Idea::create([
            'titulo' => 'Sistema de gestión de tareas escolares',
            'descripcion' => 'Plataforma para asignar y evaluar actividades académicas.',
            'estado' => 'en revisión',
            'autor' => 'Pedro Paramo',
            'categoria_id' => 2
        ]);

        Idea::create([
            'titulo' => 'Aplicación de tutorías virtuales',
            'descripcion' => 'Sistema que conecta estudiantes con tutores especializados.',
            'estado' => 'en revisión',
            'autor' => 'Andrea Coral',
            'categoria_id' => 2
        ]);

        Idea::create([
            'titulo' => 'Historial clínico digital',
            'descripcion' => 'Sistema para almacenar información médica de forma segura.',
            'estado' => 'en revisión',
            'autor' => 'Patricia Lima',
            'categoria_id' => 3
        ]);

        Idea::create([
            'titulo' => 'Monitor inteligente de medicamentos',
            'descripcion' => 'Aplicación para recordar horarios y dosis de medicinas.',
            'estado' => 'registrada',
            'autor' => 'Daniel',
            'categoria_id' => 3
        ]);

        Idea::create([
            'titulo' => 'Aplicación de monitoreo ambiental',
            'descripcion' => 'Herramienta para reportar niveles de contaminación en zonas urbanas.',
            'estado' => 'registrada',
            'autor' => 'Mónica',
            'categoria_id' => 4
        ]);

        Idea::create([
            'titulo' => 'Portal de encuestas de mercado',
            'descripcion' => 'Herramienta para recopilar opiniones y analizar tendencias de consumo.',
            'estado' => 'en revisión',
            'autor' => 'Alejandro Peña',
            'categoria_id' => 5
        ]);

        Idea::create([
            'titulo' => 'Sistema de gestión de reciclaje',
            'descripcion' => 'Plataforma para registrar materiales reciclables y puntos de recolección.',
            'estado' => 'en revisión',
            'autor' => 'Nelly Varela',
            'categoria_id' => 4
        ]);


    }
}