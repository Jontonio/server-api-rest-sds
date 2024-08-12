<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $primaryKey = 'id_unit';

    use HasFactory;
    protected $fillable = [
        'unit_name',
        'unit_description',
        'unit_start',
        'unit_finish',
        'status',
        'id_academic_program',
        'id_unit'
    ];

    protected $dates = [
        'unit_start',
        'unit_finish',
    ];

    public function academic_program()
    {
        return $this->belongsTo(Academic_program::class,'id_academic_program');
    }

    public function class_unit()
    {
        return $this->hasMany(Class_unit::class,'id_unit');
    }

}
