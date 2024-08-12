<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $primaryKey = 'id_notice';

    use HasFactory;
    protected $fillable = [
        'notice_title',
        'notice_text',
        'date_public',
        'date_expiration',
        'status',
        'notice_url_img',
        'notice_adj_file',
        'notice_autor',
        'modular_code',
    ];
    public function institution()
    {
        return $this->belongsTo(Institution::class,'modular_code');
    }
}
