<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RequestsForm;

use App\Models\Inspections;

use App\Models\User;

use App\Models\Category;

use App\Models\Item;

use App\Models\Supplier;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $requests = RequestsForm::count();
        $inspections = Inspections::count();
        
        $categories = Category::count();
        $items = Item::count();
        $suppliers = Supplier::count();

        $employees = User::count();
        return view('home', compact('requests', 'inspections', 'categories', 'items', 'suppliers', 'employees'));
    }
}
