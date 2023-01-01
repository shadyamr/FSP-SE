<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\Logs;

use Auth;

class LogsController extends Controller
{
    public function index()
    {
        $logs_all = logs::all();
        return view('logs', compact('logs_all'));
    }

    public function store($log_type, $data_id)
    {
        $log = new Logs();
        $log->log_type = $log_type;
        $log->data_id = $data_id;
        $log->data_user = Auth::user()->id;
        $log->save();
    }
}
