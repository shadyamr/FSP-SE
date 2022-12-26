<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesForm extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = [
        'employee_name', 'employee_id'
    ];
}
