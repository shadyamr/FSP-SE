<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspections extends Model
{
    use HasFactory;
    protected $table = 'inspections';

    protected $fillable = [
        'inspection_information', 'inspection_image', 'request_id', 'inspection_handler'
    ];

    public function requests()
    {
        return $this->belongsTo(RequestsForm::class, 'request_id', 'id');
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspection_handler', 'id');
    }

    public function requestsform()
    {
        return $this->belongsToMany(RequestsForm::class, 'requests_inspections');
    }
}
