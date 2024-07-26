<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $primaryKey = 'id_card';
    use HasFactory;
    protected $fillable = [
        'id_card',
        'type_id_card',
        'names',
        'first_name',
        'last_name',
        'email',
        'phone_number',
    ];
    public function institution_teacher()
    {
        return $this->hasMany(Institution_teacher::class,'id_card');
    }
}

