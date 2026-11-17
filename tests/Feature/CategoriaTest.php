<?php

use App\Models\Categoria;
use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

uses(RefreshDatabase::class);

test('Utilizar la base de datos de prueba', function () {
    expect(config('database.default'))->toBe('sqlite');
    expect(config('database.connections.sqlite.database'))->toBe(':memory:');

});

test('Registrar una categoría', function () {
   Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas del área cientifica.',
   ]);

    //dd(Categoria::all());

   $this->assertDatabaseHas('categorias',[
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas del área cientifica.'
   ]);

});

test('Consultar una categoría', function () {
   $categoria = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas del área cientifica.',
   ]);

   $encontrada = Categoria::find($categoria->id);

   expect($encontrada -> nombre) -> toBe('Ciencia');

});

test('Modificar una categoría', function () {
   $categoria = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas del área cientifica.',
   ]);

    $categoria -> update([
        'nombre' => 'Innovación',
    ]);

   $this->assertDatabaseMissing('categorias',[
        'id' => $categoria -> id,
        'nombre' => 'Ciencia',
   ]);

});

test('Eliminar una categoría', function () {
   $categoria = Categoria::create([
        'nombre' => 'Ciencia',
        'descripcion' => 'Ideas del área cientifica.',
   ]);

    $categoria -> delete();

   $this->assertDatabaseMissing('categorias',[
        'id' => $categoria -> id,
   ]);

});

test('Una categoría puede tener varias ideas', function () {
  $categoria = Categoria::create([
    'nombre' => 'Tecnología',
    'descripcion' => 'Ideas tecnológicas'
  ]);

  Idea::create([
    'titulo' => 'Aplicación de transporte',
    'descripcion' => 'Aplicación para compartir viajes',
    'autor' => 'Ana',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

  Idea::create([
    'titulo' => 'Sistema de inventario',
    'descripcion' => 'Control de productos',
    'autor' => 'Luis',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

 	expect($categoria->ideas)->toHaveCount(2);
});

test('No se puede borrar una categoría con ideas asociadas', function () {
  $categoria = Categoria::create([
    'nombre' => 'Tecnología',
    'descripcion' => 'Ideas tecnológicas'
  ]);

  Idea::create([
    'titulo' => 'Aplicación de transporte',
    'descripcion' => 'Aplicación para compartir viajes',
    'autor' => 'Ana',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

  Idea::create([
    'titulo' => 'Sistema de inventario',
    'descripcion' => 'Control de productos',
    'autor' => 'Luis',
    'estado' => 'registrada',
    'categoria_id' => $categoria->id
  ]);

    $rechazo = false;
  try{
    $categoria->delete();
  }catch(QueryException $e){
    // la base de datos impidio la eliminación
    $rechazo = true;
  }

  expect($rechazo)->toBeTrue();

    $this->assertDatabaseHas('categorias', [
        'id' => $categoria->id
    ]);
});

