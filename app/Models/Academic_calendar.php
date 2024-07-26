<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_calendar extends Model
{
    protected $primaryKey = 'id_academic_calendar';
    use HasFactory;
    protected $fillable = [
        'id_academic_calendar',
        'academic_calendar_year',
    ];
    public function academic_program()
    {
        return $this->hasMany(Academic_program::class,'id_academic_calendar');
    }
}
