<?php

namespace App\Filament\Resources;

use App\Models\TimeTable;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\TimeTableResource\Pages;

class TimeTableResource extends Resource
{
    protected static ?string $model = TimeTable::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'day';

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

                    Select::make('student_class_id')
                        ->rules(['exists:student_classes,id'])
                        ->required()
                        ->relationship('studentClass', 'name')
                        ->searchable()
                        ->placeholder('Student Class')
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

                    Select::make('teacher_id')
                        ->rules(['exists:teachers,id'])
                        ->required()
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
                        ->required()
                        ->placeholder('Hari')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('clock_in')
                        ->rules(['date_format:H:i:s'])
                        ->required()
                        ->placeholder('Jam Masuk')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DateTimePicker::make('clock_out')
                        ->rules(['date_format:H:i:s'])
                        ->required()
                        ->placeholder('Jam Keluar')
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
                Tables\Columns\TextColumn::make('studentClass.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('lesson.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('day')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('clock_in')
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('clock_out')
                    ->toggleable()
                    ->dateTime(),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('semester_id')
                    ->relationship('semester', 'name')
                    ->indicator('Semester')
                    ->multiple()
                    ->label('Semester'),

                SelectFilter::make('student_class_id')
                    ->relationship('studentClass', 'name')
                    ->indicator('StudentClass')
                    ->multiple()
                    ->label('StudentClass'),

                SelectFilter::make('lesson_id')
                    ->relationship('lesson', 'name')
                    ->indicator('Lesson')
                    ->multiple()
                    ->label('Lesson'),

                SelectFilter::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->indicator('Teacher')
                    ->multiple()
                    ->label('Teacher'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimeTables::route('/'),
            'create' => Pages\CreateTimeTable::route('/create'),
            'view' => Pages\ViewTimeTable::route('/{record}'),
            'edit' => Pages\EditTimeTable::route('/{record}/edit'),
        ];
    }
}
