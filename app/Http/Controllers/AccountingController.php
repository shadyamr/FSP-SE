<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AccountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->back();
    }

    public function salaries()
    {
        $employees_all = User::all();
        return view('accounting.salaries', compact('employees_all'));
    }

    public function edit_salaries_preview($id)
    {
        $edit_user_salary = User::find($id);
        return view('accounting.editsalaries', compact('edit_user_salary'));
    }

    public function edit_salary($id, Request $request)
    {
        $employee = User::find($id);
        
        $employee->salary = $request->input('salary');
        
        $employee->save();

        $log = new LogsController();
        if($request->input('salary') > $request->input('o_salary'))
        {
            $log->store('edit_salary:increase', $id);
        }
        else if($request->input('salary') < $request->input('o_salary'))
        {
            $log->store('edit_salary:decrease', $id);
        }
        else
        {
            $log->store('edit_salary', $id);
        }

        return redirect()->back()->with('success', 'Salary edited successfully.');
    }
}
