<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $primaryKey = 'id_college';
    use HasFactory;
    protected $fillable = [
        'id_college',
        'name_college',
    ];
    public function teacher_coor()
    {
        return $this->hasMany(Teacher_coor::class,'id_college');
    }
    public function institution_teacher()
    {
        return $this->hasMany(Institution_teacher::class,'id_college');
    }
}
