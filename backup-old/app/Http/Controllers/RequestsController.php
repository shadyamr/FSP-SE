<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RequestsForm;

class RequestsController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            'corporate_name' => $request->input('corporate_name'),
            'corporate_address' => $request->input('corporate_address'),
            'corporate_budget' => $request->input('corporate_budget'),
            'client_extra' => $request->input('client_extra'),
        ];

        RequestsForm::create($data);
        return response()->json([
            'message' => 'Client added successfully!'
        ]);
    }
}
