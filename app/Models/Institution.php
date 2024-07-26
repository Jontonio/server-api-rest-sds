<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $primaryKey = 'modular_code';
    use HasFactory;
    protected $fillable = [
        'modular_code',
        'name_ie',
        'level_modality',
        'management_dependency',
        'address_ie',
    ];
    public function institution_teacher()
    {
        return $this->hasMany(Institution_teacher::class,'modular_code');
    }
    public function academic_program()
    {
        return $this->hasMany(Academic_program::class,'modular_code');
    }
}
