<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution_teacher extends Model
{
    protected $primaryKey = 'id_ie_teacher';
    use HasFactory;
    protected $fillable = [
        'id_ie_teacher',
        'id_card',
        'modular_code',
        'id_college',
    ];
    public function teacher_area()
    {
        return $this->hasMany(Teacher_area::class,'id_ie_teacher');
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class,'modular_code');
    }
    public function college()
    {
        return $this->belongsTo(College::class,'id_college');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'id_card');
    }
}
