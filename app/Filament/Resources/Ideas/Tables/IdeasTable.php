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
use Filament\Forms\Components\TextInput; // Necesario para el campo de observación

class IdeasTable 
{ 
    public static function configure(Table $table): Table 
    { 
        return $table 
            ->heading('Proyecto Ideas - Méndez Jiménez Paola Melissa, Lozano Matus Miriam Doyel') 
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
            ->actions([ 
                EditAction::make(), 
                ViewAction::make(), 
                DeleteAction::make(),
                RestoreAction::make(), 
                ForceDeleteAction::make(), 
                
                Action::make('aprobar') 
                    ->label('Aprobar') 
                    ->color('success') 
                    ->requiresConfirmation() 
                    ->modalHeading('Confirmación') 
                    ->modalDescription('¿Desea aprobar esta idea?') 
                    ->action(function(Idea $record){ 
                        $record->update(['estado'=>'aprobada']); 
                        Notification::make() 
                            ->title('Idea aprobada con éxito.') 
                            ->success() 
                            ->send(); 
                    }) 
                    ->visible(fn(Idea $record) => $record->estado !== 'aprobada'), // Coma agregada
                
                Action::make('rechazar')
                    ->label('Rechazar') 
                    ->color('danger')
                    ->form([ 
                        TextInput::make('observacion')
                            ->label('Observación')
                            ->helperText('Motivo de rechazo')
                            ->required(),
                    ])
                    ->action(function (array $data, Idea $record): void { 
                        $record->estado = 'rechazada'; 
                        $record->observacion = $data['observacion']; 
                        $record->save(); 
                        Notification::make() 
                            ->title('Idea rechazada exitosamente.') 
                            ->success() 
                            ->send(); 
                }) 
                ->hidden(fn (Idea $record): bool => $record->estado === 'rechazada'),
            ]) 
            ->bulkActions([ 
                BulkActionGroup::make([ 
                    //DeleteBulkAction::make(), 
                ]) 
            ]); 
    } 
}
