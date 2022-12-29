<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $table = 'logs';

    protected $fillable = [
        'log_type',
        'data_id',
        'data_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'data_user', 'id');
    }
}
