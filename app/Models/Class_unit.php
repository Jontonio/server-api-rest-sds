<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_unit extends Model
{
    protected $primaryKey = 'id_class_unit';
    use HasFactory;
    protected $fillable = [
        'id_class_unit',
        'class_unit_title',
        'class_unit_description',
        'class_unit_file_url',
        'id_teacher_area',
        'id_academic_program',
    ];

    public function teacher_area()
    {
        return $this->belongsTo(Teacher_area::class,'id_teacher_area');
    }
    public function scademic_program()
    {
        return $this->belongsTo(Academic_program::class,'id_academic_program');
    }
}
