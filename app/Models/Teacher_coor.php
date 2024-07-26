<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_coor extends Model
{
    protected $primaryKey = 'id_teacher_coor';
    use HasFactory;
    protected $fillable = [
        'id_teacher_coor',
        'id_ie_teacher',
        'id_college',
    ];

    public function college()
    {
        return $this->belongsTo(College::class,'id_college');
    }
    public function institution_teacher()
    {
        return $this->belongsTo(Institution_teacher::class,'id_ie_teacher');
    }
}
