<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date_birth' => 'date',
    ];

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
