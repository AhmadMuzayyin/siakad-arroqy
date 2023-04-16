<?php

namespace App\Filament\Resources;

use App\Models\Score;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\ScoreResource\Pages;

class ScoreResource extends Resource
{
    protected static ?string $model = Score::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('semester_id')
                        ->rules(['exists:semesters,id'])
                        ->required()
                        ->relationship('semester', 'name')
                        ->searchable()
                        ->placeholder('Semester')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('student_id')
                        ->rules(['exists:students,id'])
                        ->required()
                        ->relationship('student', 'name')
                        ->searchable()
                        ->placeholder('Student')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('lesson_id')
                        ->rules(['exists:lessons,id'])
                        ->required()
                        ->relationship('lesson', 'name')
                        ->searchable()
                        ->placeholder('Lesson')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('attendance')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Nilai Absen')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('test')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Nilai Ujian')
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
                Tables\Columns\TextColumn::make('semester.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('student.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('lesson.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('attendance')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('test')
                    ->toggleable()
                    ->searchable(true, null, true),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('semester_id')
                    ->relationship('semester', 'name')
                    ->indicator('Semester')
                    ->multiple()
                    ->label('Semester'),

                SelectFilter::make('student_id')
                    ->relationship('student', 'name')
                    ->indicator('Student')
                    ->multiple()
                    ->label('Student'),

                SelectFilter::make('lesson_id')
                    ->relationship('lesson', 'name')
                    ->indicator('Lesson')
                    ->multiple()
                    ->label('Lesson'),
            ]);
    }

    public static function getRelations(): array
    {
        return [ScoreResource\RelationManagers\RaportsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScores::route('/'),
            'create' => Pages\CreateScore::route('/create'),
            'view' => Pages\ViewScore::route('/{record}'),
            'edit' => Pages\EditScore::route('/{record}/edit'),
        ];
    }
}
