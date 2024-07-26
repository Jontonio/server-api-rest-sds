<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $primaryKey = 'id_area';
    use HasFactory;
    protected $fillable = [
        'id_area',
        'area_name',
    ];
    public function teacher_area()
    {
        return $this->hasMany(Teacher_area::class,'id_area');
    }
}
