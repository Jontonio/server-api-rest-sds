<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $primaryKey = 'id_section';
    use HasFactory;
    protected $fillable = [
        'id_section',
        'section_name',
    ];
    public function teacher_area()
    {
        return $this->hasMany(Teacher_area::class,'id_section');
    }
}

