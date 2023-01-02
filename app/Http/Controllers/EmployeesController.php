<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Role;

use App\Models\UserRole;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees_all = User::with('roles')->get();
        $list_roles = Role::all();
        return view('employees.index', compact('employees_all', 'list_roles'));
    }

    public function store(Request $request)
    {
        $full_name_no_space = str_replace(' ', '', $request->input('employee_name'));
        $last_four_ssn = substr($request->input('employee_ssn'), -4);
        $combine = $full_name_no_space . $last_four_ssn;
        $password = password_hash($combine, PASSWORD_BCRYPT);

        $employee = new User();

        $employee->name = $request->input('employee_name');
        $employee->email = $request->input('employee_email');
        $employee->password = $password;
        $employee->ssn = $request->input('employee_ssn');
        $employee->address = $request->input('employee_address');
        $employee->phone = $request->input('employee_phone');
        $employee->salary = $request->input('employee_salary');

        $employee->save();

        $role = new UserRole();
        
        switch($request->input('employee_role'))
        {
            case 1:
                $role->role_id = 1;
                break;
            case 2:
                $role->role_id = 3;
                break;
            case 3:
                $role->role_id = 3;
                break;
            case 4:
                $role->role_id = 4;
                break;
            case 5:
                $role->role_id = 5;
                break;
            default:
                $role->role_id = 1;
                break;            
        }

        $role->user_id = $employee->id;
        $role->save();

        $log = new LogsController();
        $log->store('create_employee', $employee->id);

        return redirect()->back()->with('success', 'Employee created successfully.');
    }

    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        $log = new LogsController();
        $log->store('delete_employee', $id);

        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }

    public function edit_employee_preview($id)
    {
        $employee = User::find($id);
        $list_roles = Role::all();
        return view('employees.edit', compact('employee', 'list_roles'));
    }

    public function edit_employee($id, Request $request)
    {
        $request->validate([
            'employee_name' => 'required',
            'employee_email' => 'required',
            'employee_ssn' => 'required',
            'employee_address' => 'required',
            'employee_phone' => 'required',
            'employee_role' => 'required',
        ]);

        $employee = User::find($id);
        $employee->name = $request->input('employee_name');
        $employee->email = $request->input('employee_email');
        $employee->ssn = $request->input('employee_ssn');
        $employee->address = $request->input('employee_address');
        $employee->phone = $request->input('employee_phone');

        if($request->input('employee_password') != "")
        {
            $employee->password = password_hash($request->input('employee_password'), PASSWORD_BCRYPT);
        }

        $employee->save();

        UserRole::where('user_id', $id)->update(['role_id' => $request->input('employee_role')]);

        $log = new LogsController();
        $log->store('edit_employee', $employee->id);

        return redirect()->back()->with('success', 'Employee edited successfully.');
    }
}
