<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function timeTables()
    {
        return $this->hasMany(TimeTable::class);
    }
}
