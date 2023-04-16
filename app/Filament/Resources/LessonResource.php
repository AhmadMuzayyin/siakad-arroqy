<?php

namespace App\Filament\Resources;

use App\Models\Lesson;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\LessonResource\Pages;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
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
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('studentClass.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('student_class_id')
                    ->relationship('studentClass', 'name')
                    ->indicator('StudentClass')
                    ->multiple()
                    ->label('StudentClass'),

                SelectFilter::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->indicator('Teacher')
                    ->multiple()
                    ->label('Teacher'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LessonResource\RelationManagers\ScoresRelationManager::class,
            LessonResource\RelationManagers\TimeTablesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'view' => Pages\ViewLesson::route('/{record}'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
