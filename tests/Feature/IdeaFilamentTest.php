<?php
use App\Models\User;
use App\Models\Idea;
use App\Models\Categoria;
use App\Filament\Resources\Ideas\Pages\EditIdea;
use App\Filament\Resources\Ideas\Pages\ListIdeas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
uses(RefreshDatabase::class);

beforeEach(function(){
    $this -> usuario = User::factory()->create([
        'rol' => 'admin'
    ]);

    $this -> actingAs($this -> usuario);

    $this -> categoria = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas del área cientifica.',
    ]);

    $this -> idea = Idea::create([
        'titulo' => 'Aplicación de transporte',
        'descripcion' => 'Aplicación para compartir viajes',
        'autor' => 'Ana',
        'estado' => 'registrada',
        'categoria_id' => $this->categoria->id
    ]);
});

test('Editar una idea', function(){
    Livewire::test(EditIdea::class, [
        'record' => $this -> idea -> id
    ])
    ->assertSuccessful() //Comprueba el ID
    ->assertSchemaStateSet([
        'titulo' => 'Aplicación de transporte',
        'descripcion' => 'Aplicación para compartir viajes',
    ]) //Comprueba que los datos sean los correctos
    ->fillForm([
        'titulo' => 'Aplicación de transporte canino',
        'descripcion' => 'Aplicación para compartir viajes caninos',
    ])
    ->call('save') //Guarda
    ->assertHasNoFormErrors() //Comprueba que no hayan errores.
    ->assertNotified();
});

test('Editar una idea sin descripción', function(){
    Livewire::test(EditIdea::class, [
        'record' => $this -> idea -> id
    ])

    ->fillForm([
        'titulo' => 'Aplicación de transporte canino',
        'descripcion' => '',
    ])
    ->call('save') //Guarda
    ->assertHasFormErrors([
        'descripcion' => 'required'
    ]); //Comprueba que hayan errores.

    $this->assertDatabaseHas('ideas', [
        'id' => 1,
        'titulo' => 'Aplicación de transporte',
        'descripcion' => 'Aplicación para compartir viajes',
    ]);
});
