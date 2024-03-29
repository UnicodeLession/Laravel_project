<?php

namespace Modules\Lesson\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $table = 'lessons';
    protected $fillable = [
        'name',
        'slug',
        'video_id',
        'document_id',
        'parent_id',
        'is_trial',
        'views',
        'position',
    ];
}
