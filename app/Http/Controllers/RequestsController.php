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
        $requests_all = RequestsForm::select(DB::raw('*,
                                                            requests.id AS requestID,
                                                            requests.updated_at AS requestUpdated,
                                                            requests.created_at AS requestCreated,
                                                            users.id AS handlerID,
                                                            users.name as handlerName'))
                                    ->leftJoin('users', 'requests.handler', '=', 'users.id')
                                    ->get();
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
}
