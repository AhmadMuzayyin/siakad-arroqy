<?php

namespace App\Filament\Resources\StudentClassResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\RelationManager;

class TimeTablesRelationManager extends RelationManager
{
    protected static string $relationship = 'timeTables';

    protected static ?string $recordTitleAttribute = 'day';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('semester_id')
                    ->rules(['exists:semesters,id'])
                    ->relationship('semester', 'name')
                    ->searchable()
                    ->placeholder('Semester')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('lesson_id')
                    ->rules(['exists:lessons,id'])
                    ->relationship('lesson', 'name')
                    ->searchable()
                    ->placeholder('Lesson')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('teacher_id')
                    ->rules(['exists:teachers,id'])
                    ->relationship('teacher', 'name')
                    ->searchable()
                    ->placeholder('Teacher')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('day')
                    ->rules(['max:255', 'string'])
                    ->placeholder('Hari')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                DateTimePicker::make('clock_in')
                    ->rules(['date_format:H:i:s'])
                    ->placeholder('Jam Masuk')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                DateTimePicker::make('clock_out')
                    ->rules(['date_format:H:i:s'])
                    ->placeholder('Jam Keluar')
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
                Tables\Columns\TextColumn::make('semester.name')->limit(50),
                Tables\Columns\TextColumn::make('studentClass.name')->limit(50),
                Tables\Columns\TextColumn::make('lesson.name')->limit(50),
                Tables\Columns\TextColumn::make('teacher.name')->limit(50),
                Tables\Columns\TextColumn::make('day')->limit(50),
                Tables\Columns\TextColumn::make('clock_in')->dateTime(),
                Tables\Columns\TextColumn::make('clock_out')->dateTime(),
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

                MultiSelectFilter::make('semester_id')->relationship(
                    'semester',
                    'name'
                ),

                MultiSelectFilter::make('student_class_id')->relationship(
                    'studentClass',
                    'name'
                ),

                MultiSelectFilter::make('lesson_id')->relationship(
                    'lesson',
                    'name'
                ),

                MultiSelectFilter::make('teacher_id')->relationship(
                    'teacher',
                    'name'
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
