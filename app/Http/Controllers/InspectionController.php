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
        // get all requests with the handler information via relationship
        /*$requests_all = RequestsForm::with('user')->get();
        return view('requests', compact('requests_all'));*/
        return view('inspections');
    }
}
