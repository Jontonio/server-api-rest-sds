<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $primaryKey = 'id_grade';
    use HasFactory;
    protected $fillable = [
        'id_grade',
        'grade_name',
    ];

    public function teacher_area()
    {
        return $this->hasMany(Teacher_area::class,'id_grade');
    }
}
