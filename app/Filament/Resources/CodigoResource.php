<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CodigoResource\Pages;
use App\Filament\Resources\CodigoResource\RelationManagers;
use App\Models\Codigo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CodigoResource extends Resource
{
    protected static ?string $model = Codigo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),
                Forms\Components\Textarea::make('descripcion')
                    ->columnSpan(1),
                Forms\Components\Toggle::make('usado')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false)
                    ->required(), 
                Forms\Components\DatePicker::make('fecha_vencimiento'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\IconColumn::make('usado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('fecha_vencimiento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCodigos::route('/'),
            'create' => Pages\CreateCodigo::route('/create'),
            'edit' => Pages\EditCodigo::route('/{record}/edit'),
        ];
    }
}
