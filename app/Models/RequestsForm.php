<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestsForm extends Model
{
    use HasFactory;
    protected $table = 'requests';

    protected $fillable = [
        'corporate_name',
        'corporate_address',
        'corporate_budget',
        'corporate_owner',
        'corporate_mobile',
        'corporate_phone',
        'corporate_email',
        'client_extra',
        'handler'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'handler', 'id');
    }

    public function inspections()
    {
        return $this->belongsToMany(Inspections::class, 'requests_inspections');
    }
}
