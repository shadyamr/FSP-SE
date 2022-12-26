<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\RequestsForm;

class RequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = [
            'corporate_name' => $request->input('corporate_name'),
            'corporate_address' => $request->input('corporate_address'),
            'corporate_budget' => $request->input('corporate_budget'),
            'client_extra' => $request->input('client_extra'),
        ];

        RequestsForm::create($data);
        
        return redirect()->back()->with('success', 'Request submitted successfully.');
    }
}
