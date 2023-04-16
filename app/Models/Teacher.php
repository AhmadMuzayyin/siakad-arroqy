<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    public function homeroomTeachers()
    {
        return $this->hasMany(HomeroomTeacher::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function timeTables()
    {
        return $this->hasMany(TimeTable::class);
    }
}
