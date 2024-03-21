<?php

namespace App\Filament\Resources\SeccionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeriesRelationManager extends RelationManager
{
    protected static string $relationship = 'series';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getGeneralSection(),
                $this->getValoresDocumentalesSection(),
                $this->getValoresConcervacionSection(),
                $this->getValoresAccesoSection(),
                $this->getDestinoFinalSection()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('ids')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getGeneralSection(): Component{
        return Section::make(heading: 'Datos Generales')
        ->schema([
            Forms\Components\TextInput::make('ids')
                    ->required()
                    ->unique(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique()
                    ->maxLength(255),
        ]);
    }

    protected function getValoresDocumentalesSection(): Component{
        return Section::make(heading: 'Valores Documentales')
        ->schema([
            Forms\Components\Checkbox::make('administrativo'),
            Forms\Components\Checkbox::make('contable_fiscal'),
            Forms\Components\Checkbox::make('legal'),
        ]);
    }

    protected function getValoresConcervacionSection(): Component{
        return Section::make(heading: 'Valores de Conservación')
        ->schema([
            Forms\Components\TextInput::make('tramite')->label('Archivo de Tramite Años')->numeric(),
            Forms\Components\TextInput::make('concentracion')->label('Archivo de Concentración Años')->numeric(),
            Forms\Components\Checkbox::make('historico'),
        ]);
    }

    protected function getValoresAccesoSection(): Component{
        return Section::make(heading: 'Valores de Acceso')
        ->schema([
            Forms\Components\Checkbox::make('publico'),
            Forms\Components\Checkbox::make('reservado'),
            Forms\Components\Checkbox::make('confidencial'),
        ]);
    }

    protected function getDestinoFinalSection(): Component{
        return Section::make(heading: 'Destino Final')
        ->schema([
            Forms\Components\Checkbox::make('baja'),
            Forms\Components\Checkbox::make('permanente'),
        ]);
    }
}
