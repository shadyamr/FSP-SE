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
        $list_requests = RequestsForm::all();
        return view('inspections', compact('inspections_all', 'list_requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'requests_id' => 'required',
            'inspection_info' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!$request->hasFile('image'))
        {
            return redirect()->back()->with('error', 'No file was uploaded');
        }

        $image = $request->file('image');
        if (!$image->isValid())
        {
            return redirect()->back()->with('error', 'The uploaded file is not valid');
        }

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('img/inspections/'), $imageName);

        $submit_inspection = new Inspections([
            'request_id' => $request->get('requests_id'),
            'inspection_information' => $request->get('inspection_info'),
            'inspection_image' => 'img/inspections/' . $imageName,
            'inspection_handler' => Auth::user()->id,
        ]);
        $submit_inspection->save();

        $request = RequestsForm::find($request->get('requests_id'));
        $request->inspections()->attach($submit_inspection);

        $log = new LogsController();
        $log->store('make_inspection', $submit_inspection->id);

        return redirect()->back()->with('success', 'Inspection created successfully.');
    }

    public function destroy($id)
    {
        $inspection = Inspections::findOrFail($id);
        $inspection->delete();

        $log = new LogsController();
        $log->store('delete_inspection', $id);

        return redirect()->back()->with('success', 'Inspection deleted successfully.');
    }

    public function edit($id)
    {
        $edit_inspection = Inspections::find($id);
        $users = User::all();
        $list_requests = RequestsForm::all();
        return view('edit-inspections', compact('edit_inspection', 'users', 'list_requests'));
    }

    public function store_edit($id, Request $request)
    {
        $request->validate([
            'requests_id' => 'required',
            'inspection_info' => 'required',
            'inspector_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $inspection = Inspections::find($id);
        
        $inspection->request_id = $request->input('requests_id');
        $inspection->inspection_information = $request->input('inspection_info');
        $inspection->inspection_handler = $request->input('inspector_id');

        if($request->file('image'))
        {
            $image = $request->file('image');
            if (!$image->isValid())
            {
                return redirect()->back()->with('error', 'The uploaded file is not valid');
            }
    
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            $image->move(public_path('img/inspections/'), $imageName);
            $inspection->inspection_image = 'img/inspections/' . $imageName;
        }

        $inspection->save();

        $request = RequestsForm::find($request->get('requests_id'));
        $request->inspections()->sync($id);

        $log = new LogsController();
        $log->store('edit_inspection', $id);

        return redirect()->back()->with('success', 'Inspection edited successfully.');
    }
}
