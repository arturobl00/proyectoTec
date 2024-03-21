<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeccionResource\Pages;
use App\Filament\Resources\SeccionResource\RelationManagers;
use App\Filament\Resources\SeccionResource\RelationManagers\SeriesRelationManager;
use App\Models\Seccion;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Console\Input\Input;

class SeccionResource extends Resource
{
    protected static ?string $model = Seccion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel  = 'Formulario Secciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('ids')->required()->unique(),
                TextInput::make('name')->required()->unique(),
                Select::make('funcion')->options([
                    'Comunes' => 'Comunes',
                    'Sustantivas' => 'Sustantivas',
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('funcion')->sortable(),
                TextColumn::make('ids')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
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
            SeriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeccions::route('/'),
            'create' => Pages\CreateSeccion::route('/create'),
            'edit' => Pages\EditSeccion::route('/{record}/edit'),
        ];
    }
}
