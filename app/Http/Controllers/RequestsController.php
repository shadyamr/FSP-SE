<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Inspections;
use App\Models\RequestsForm;

use App\Models\User;

use Auth;

class RequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // get all requests with the handler information via relationship
        $requests_all = RequestsForm::with('user')->get();
        return view('requests', compact('requests_all'));
    }

    public function store(Request $request)
    {
        $data = [
            'corporate_name' => $request->input('corporate_name'),
            'corporate_address' => $request->input('corporate_address'),
            'corporate_budget' => $request->input('corporate_budget'),
            'corporate_owner' => $request->input('corporate_owner'),
            'corporate_mobile' => $request->input('corporate_mobile'),
            'corporate_phone' => $request->input('corporate_phone'),
            'corporate_email' => $request->input('corporate_email'),
            'client_extra' => $request->input('client_extra'),
            'handler' => Auth::user()->id,
        ];

        $requests = RequestsForm::create($data);
        
        $log = new LogsController();
        $log->store('make_request', $requests->id);

        return redirect()->back()->with('success', 'Request submitted successfully.');
    }

    public function destroy($id)
    {
        $requests = RequestsForm::findOrFail($id);
        $requests->delete();

        Inspections::where('request_id', $id)->delete();

        $log = new LogsController();
        $log->store('delete_request', $id);

        return redirect()->back()->with('success', 'Request deleted successfully.');
    }

    public function edit($id)
    {
        //$ = RequestsForm::findOrFail(1);
        $edit_requests = RequestsForm::find($id);
        $users = User::all();
        //return $edit_requests;
        return view('edit-requests', compact('edit_requests', 'users'));
    }

    public function store_edit($id, Request $request)
    {
        $requests = RequestsForm::find($id);
        
        $requests->corporate_name = $request->input('corporate_name');
        $requests->corporate_address = $request->input('corporate_address');
        $requests->corporate_budget = $request->input('corporate_budget');
        $requests->corporate_owner = $request->input('corporate_owner');
        $requests->corporate_mobile = $request->input('corporate_mobile');
        $requests->corporate_phone = $request->input('corporate_phone');
        $requests->corporate_email = $request->input('corporate_email');
        $requests->client_extra = $request->input('client_extra');
        $requests->handler = $request->input('handler');
        
        $requests->save();

        $log = new LogsController();
        $log->store('edit_request', $id);

        return redirect()->back()->with('success', 'Request edited successfully.');
    }
}
