<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees_all = User::all();
        return view('employees.index', compact('employees_all'));
    }
}
