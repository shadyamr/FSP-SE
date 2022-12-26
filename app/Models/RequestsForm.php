<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestsForm extends Model
{
    use HasFactory;
    protected $table = 'requests';

    protected $fillable = [
        'corporate_name', 'corporate_address', 'corporate_budget', 'client_extra', 'handler'
    ];
}
