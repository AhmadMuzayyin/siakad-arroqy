<?php

namespace App\Filament\Resources\ScoreResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class RaportsRelationManager extends RelationManager
{
    protected static string $relationship = 'raports';

    protected static ?string $recordTitleAttribute = 'principal_signature';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                FileUpload::make('signature')
                    ->rules(['image', 'max:1024'])
                    ->image()
                    ->placeholder('Signature')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                FileUpload::make('principal_signature')
                    ->rules(['image', 'max:1024'])
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
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('score.id')->limit(50),
                Tables\Columns\ImageColumn::make('signature')->rounded(),
                Tables\Columns\ImageColumn::make(
                    'principal_signature'
                )->rounded(),
                Tables\Columns\TextColumn::make('status')->enum([
                    'already_printed' => 'Already printed',
                    'not_printed_yet' => 'Not printed yet',
                    'confirmed' => 'Confirmed',
                    'not_confirmed' => 'Not confirmed',
                ]),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('score_id')->relationship(
                    'score',
                    'id'
                ),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
