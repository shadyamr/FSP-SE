<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('stock.category.index', compact('categories'));
    }

    public function showAdd()
    {
        return view('stock.category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        $log = new LogsController();
        $log->store('new_category', Auth::user()->id);

        return redirect()->route('category')->with(['message' => 'Category added', 'alert' => 'alert-success']);
    }

    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        $log = new LogsController();
        $log->store('delete_category', Auth::user()->id);

        return redirect()->route('category')->with(['message' => 'Category deleted', 'alert' => 'alert-danger']);
    }

    public function showEdit($id)
    {
        $category = Category::find($id);

        return view('stock.category.edit', compact('category'));
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $category->name = $request->name;

        $category->save();

        $log = new LogsController();
        $log->store('edit_category', Auth::user()->id);

        return redirect()->route('category')->with(['message' => 'Category updated', 'alert' => 'alert-success']);
    }
}
