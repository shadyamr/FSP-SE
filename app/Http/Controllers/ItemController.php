<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('status', 'DESC')->get();
        return view('stock.item.index', compact('items'));
    }

    public function showAdd()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('stock.item.add', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'serial_number' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);

        Item::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id
        ]);

        $log = new LogsController();
        $log->store('make_item', Auth::user()->id);

        return redirect()->route('item')->with(['message' => 'Item added', 'alert' => 'alert-success']);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        $log = new LogsController();
        $log->store('delete_item', Auth::user()->id);

        return redirect()->route('item')->with(['message' => 'Item deleted', 'alert' => 'alert-success']);
    }

    public function showEdit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('stock.item.edit', compact('item', 'categories', 'suppliers'));
    }

    public function update($id, Request $request)
    {
        $item = Item::find($id);

        $request->validate([
            'name' => 'required',
            'serial_number' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);

        $item->name = $request->name;
        $item->serial_number = $request->serial_number;
        $item->status = $request->status;
        $item->category_id = $request->category_id;
        $item->supplier_id = $request->supplier_id;
        $item->save();

        $log = new LogsController();
        $log->store('edit_item', Auth::user()->id);

        return redirect()->route('item')->with(['message' => 'Item updated', 'alert' => 'alert-warning']);
    }
}
