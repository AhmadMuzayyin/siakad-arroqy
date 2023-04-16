<?php

namespace App\Filament\Resources;

use App\Models\Raport;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\RaportResource\Pages;

class RaportResource extends Resource
{
    protected static ?string $model = Raport::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'principal_signature';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('score_id')
                        ->rules(['exists:scores,id'])
                        ->required()
                        ->relationship('score', 'id')
                        ->searchable()
                        ->placeholder('Score')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    FileUpload::make('signature')
                        ->rules(['image', 'max:1024'])
                        ->required()
                        ->image()
                        ->placeholder('Signature')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    FileUpload::make('principal_signature')
                        ->rules(['image', 'max:1024'])
                        ->required()
                        ->image()
                        ->placeholder('Principal Signature')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('status')
                        ->rules([
                            'in:already_printed,not_printed_yet,confirmed,not_confirmed',
                        ])
                        ->required()
                        ->searchable()
                        ->options([
                            'already_printed' => 'Already printed',
                            'not_printed_yet' => 'Not printed yet',
                            'confirmed' => 'Confirmed',
                            'not_confirmed' => 'Not confirmed',
                        ])
                        ->placeholder('Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('score.id')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\ImageColumn::make('signature')
                    ->toggleable()
                    ->circular(),
                Tables\Columns\ImageColumn::make('principal_signature')
                    ->toggleable()
                    ->circular(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable()
                    ->enum([
                        'already_printed' => 'Already printed',
                        'not_printed_yet' => 'Not printed yet',
                        'confirmed' => 'Confirmed',
                        'not_confirmed' => 'Not confirmed',
                    ]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('score_id')
                    ->relationship('score', 'id')
                    ->indicator('Score')
                    ->multiple()
                    ->label('Score'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRaports::route('/'),
            'create' => Pages\CreateRaport::route('/create'),
            'view' => Pages\ViewRaport::route('/{record}'),
            'edit' => Pages\EditRaport::route('/{record}/edit'),
        ];
    }
}
