<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_program extends Model
{
    protected $primaryKey = 'id_academic_program';

    use HasFactory;
    protected $fillable = [
        'id_academic_program',
        'academic_program_bim',
        'academic_program_start',
        'academic_program_finish',
        'modular_code',
        'id_academic_calendar',
    ];

    protected $dates = [
        'academic_program_start',
        'academic_program_finish',
    ];

    public function unit()
    {
        return $this->hasMany(Unit::class,'id_academic_program');
    }
    public function institution()
    {
        return $this->belongsTo(Institution::class,'modular_code');
    }
    public function academic_calendar()
    {
        return $this->belongsTo(Academic_calendar::class,'id_academic_calendar');
    }
}
