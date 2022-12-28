<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspections extends Model
{
    use HasFactory;
    protected $table = 'inspection';

    protected $fillable = [
        'inspection_info', 'inspection_image','inspection_id'
    ];
}
