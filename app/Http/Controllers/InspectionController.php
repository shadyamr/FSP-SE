<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\RequestsForm;

use App\Models\Inspections;

use App\Models\User;

use Auth;

class InspectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // get all inspections with the linked request information via relationship
        $inspections_all = Inspections::with('requests')->get();
        return view('inspections', compact('inspections_all'));
        //return view('inspections');
    }

    public function destroy($id)
    {
        $inspection = Inspections::findOrFail($id);
        $inspection->delete();

        $log = new LogsController();
        $log->store('delete_inspection', $id);

        return redirect()->back()->with('success', 'Inspection deleted successfully.');
    }
}
