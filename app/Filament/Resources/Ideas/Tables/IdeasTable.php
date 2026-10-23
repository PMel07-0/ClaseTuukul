<?php

namespace App\Filament\Resources\Ideas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\Action;
use App\Models\Idea;
use Filament\Notifications\Notification;


class IdeasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Proyecto Ideas - Méndez Jiménez Paola Melissa')
            ->columns([
                // 1. Columna del número de fila
                TextColumn::make('id')
                    ->label('#')
                    ->rowIndex(),

                // 2. Columna del título
                TextColumn::make('titulo')
                    ->label('Idea')
                    ->wrap()
                    ->searchable()
                    ->sortable(),

                // 3. Columna de descripción
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->wrap()
                    ->searchable()
                    ->sortable(),

                // 4. Columna del estado de la idea
                TextColumn::make('estado')
                    ->label('Estado')
                    ->sortable(),

                // 5. Columna del autor
                TextColumn::make('autor')
                    ->label('Autor')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                // 6. Columna de relación con Categoría
                TextColumn::make('categoria.nombre')
                    ->label('Categoría')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                // 7. Columna de fechas de creado
                TextColumn::make('created_at')
                    ->label('Creado el')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // 8. Actualizado el
                TextColumn::make('updated_at')
                    ->label('Actualizado el')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // 9. Filtros para el estado
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'registrada' => 'Registrada',
                        'en revisión' => 'En revision',
                        'aprobada' => 'Aprobada',      
                        'rechazada' => 'Rechazada',
                    ]),
                    TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                Deleteaction::make(),
                Restoreaction::make(),
                ForceDeleteaction::make(),
                Action::make('aprobar') 
                    ->label('Aprobar')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Confirmación')
                    ->modalDescription('¿Desea aprobar esta idea?')
                ->Action(function(Idea $record){
                    $record->update(['estado'=>'aprobada']);
                    Notification::make()
                        ->Title('Idea aprobada con éxito.')
                        ->success()
                        ->send();
                })
                ->visible(fn(Idea $record) => $record->estado !== 'aprobada')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                   //DeleteBulkAction::make(),
                ])
            ]);
    }
}