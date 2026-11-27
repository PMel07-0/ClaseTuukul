<?php
use App\Models\User;
use App\Models\Idea;
use App\Models\Categoria;
use App\Filament\Resources\Ideas\Pages\EditIdea;
use App\Filament\Resources\Ideas\Pages\ListIdeas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Filament\Actions\Testing\TestAction;

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

test('Aprobar una idea', function(){
    Livewire::test(ListIdeas::class) //Listado de ideas
        ->assertSuccessful() //Verificación de una entrada correcta
        ->assertCanSeeTableRecords([ //Que pueda ver los registros de la tabla
            $this->idea
        ])
        ->assertActionVisible(TestAction::make('aprobar')->table($this->idea)) //Que exista el botón de aprobar
        ->callAction(TestAction::make('aprobar')->table($this->idea)); //Apretar el boton de aceptar
    $this->assertDatabaseHas('ideas', [
        'id' => 1,
        'estado' => 'aprobada',
    ]);
});

test('Rechazar una idea', function(){
    Livewire::test(ListIdeas::class) //Listado de ideas
        ->assertSuccessful() //Verificación de una entrada correcta
        ->assertCanSeeTableRecords([ //Que pueda ver los registros de la tabla
            $this->idea
        ])
        ->assertActionVisible(TestAction::make('rechazar')->table($this->idea)) //Que exista el botón de rechazar
        ->callAction(TestAction::make('rechazar')->table($this->idea),
        data:[
            'observacion' => 'La idea necesita más información'
        ]) //Apretar el boton de rechazar
        ->assertHasNoTableActionErrors();
    $this->assertDatabaseHas('ideas', [
        'id' => 1,
        'estado' => 'rechazada',
    ]);
});


