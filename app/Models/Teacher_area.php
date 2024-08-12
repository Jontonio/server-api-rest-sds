<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_area extends Model
{
    protected $primaryKey = 'id_teacher_area';
    use HasFactory;
    protected $fillable = [
        'id_teacher_area',
        'id_ie_teacher',
        'id_area',
        'id_grade',
        'id_section',
    ];
    public function class_unit()
    {
        return $this->hasMany(Class_unit::class,'id_teacher_area');
    }
    public function institution_teacher()
    {
        return $this->belongsTo(Institution_teacher::class,'id_ie_teacher');
    }
    public function area()
    {
        return $this->belongsTo(Area::class,'id_area');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class,'id_grade');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'id_section');
    }
}
