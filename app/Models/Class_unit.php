<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_unit extends Model
{
    protected $primaryKey = 'id_class_unit';
    protected $appends = ['recive_msg'];

    use HasFactory;
    protected $fillable = [
        'id_class_unit',
        'class_unit_title',
        'class_unit_description',
        'class_unit_file_url',
        'id_teacher_area',
        'id_academic_program',
        'id_unit',
    ];

    public function getReciveMsgAttribute()
    {
        $unit_date_start = $this->unit->unit_date_start;
        $created_at = $this->created_at;

        $days_diff = intval($created_at->diffInDays($unit_date_start, false));

        if ($days_diff < 0) {
            return "Felicidades registro su unidad " . abs($days_diff) . " días antes";
        } elseif ($days_diff > 0) {
            return "Unidad registrada " . abs($days_diff) . " días después";
        } else {
            return "Felicidades unidad registrada a tiempo";
        }
    }

     /**
     * Get the full URL for the class unit file.
     *
     * @return string
     */
    public function getClassUnitFileUrlAttribute()
    {
        return asset($this->attributes['class_unit_file_url']);
    }

    public function teacher_area()
    {
        return $this->belongsTo(Teacher_area::class,'id_teacher_area');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class,'id_unit');
    }
}
