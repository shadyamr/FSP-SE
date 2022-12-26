<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\RequestsForm;

use Auth;

class RequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$requests_all = RequestsForm::all();
        $requests_all = RequestsForm::with('handler')->get();
        return view('requests', compact('requests_all'));
    }

    public function store(Request $request)
    {
        $data = [
            'corporate_name' => $request->input('corporate_name'),
            'corporate_address' => $request->input('corporate_address'),
            'corporate_budget' => $request->input('corporate_budget'),
            'client_extra' => $request->input('client_extra'),
            'handler' => Auth::user()->id,
        ];

        RequestsForm::create($data);
        
        return redirect()->back()->with('success', 'Request submitted successfully.');
    }

    public function destroy($id)
    {
        $requests = RequestsForm::findOrFail($id);
        $requests->delete();

        return redirect()->back()->with('success', 'Request deleted successfully.');
    }

    public function edit($id)
    {
        //$ = RequestsForm::findOrFail(1);
        $requests = RequestsForm::where('id', $id);

        return view('edit-requests', compact('requests'));
    }
}
