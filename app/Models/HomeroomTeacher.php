<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeroomTeacher extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    protected $table = 'homeroom_teachers';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class);
    }
}
