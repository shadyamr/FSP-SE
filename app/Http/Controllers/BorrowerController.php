<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Item;
use Illuminate\Http\Request;
use Auth;

class BorrowerController extends Controller
{
    public function index()
    {
        $borrowers = Borrower::orderBy('status', 'DESC')->get();
        return view('stock.borrower.index', compact('borrowers'));
    }

    public function showAdd()
    {
        $items = Item::where('status', 1)->get();
        return view('stock.borrower.add', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'staff_id' => 'required',
            'item_id' => 'required',
            'user_id' => 'required',
        ]);

        $this->changeItemStatus($request->item_id);

        Borrower::create([
            'name' => $request->name,
            'staff_id' => $request->staff_id,
            'item_id' => $request->item_id,
            'user_id' => $request->user_id,
            'status' => 1,
        ]);

        $log = new LogsController();
        $log->store('create_borrower', Auth::user()->id);

        return redirect()->route('borrower')->with(['message' => 'Borrower added', 'alert' => 'alert-success']);
    }

    public function destroy($id)
    {
        $borrower = Borrower::find($id)->delete();
        $log = new LogsController();
        $log->store('delete_borrower', Auth::user()->id);
        return redirect()->route('borrower')->with(['message' => 'Borrower deleted', 'alert' => 'alert-danger']);
    }

    public function showEdit($id)
    {
        $borrower = Borrower::find($id);
        $items = Item::where('status', 1)->get();

        return view('stock.borrower.edit', compact('borrower', 'items'));
    }

    public function update($id, Request $request)
    {
        $borrower = Borrower::find($id);

        $request->validate([
            'name' => 'required',
            'staff_id' => 'required',
            'item_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);

        if ($borrower->item_id != $request->item_id) {
            $this->changeItemStatus($request->item_id);
            $this->changeItemStatus($borrower->item_id);
        }

        if ($request->status != $borrower->status) {
            $this->changeItemStatus($request->item_id);
        }


        $borrower->name = $request->name;
        $borrower->staff_id = $request->staff_id;
        $borrower->item_id = $request->item_id;
        $borrower->user_id = $request->user_id;
        $borrower->status = $request->status;

        $borrower->save();

        $log = new LogsController();
        $log->store('edit_borrower', Auth::user()->id);

        return redirect()->route('borrower')->with(['message' => 'Borrower updated', 'alert' => 'alert-success']);
    }

    public function changeItemStatus($id)
    {
        $item = Item::find($id);
        if ($item->status == 0) {
            $item->status = 1;
        } else {
            $item->status = 0;
        }

        $item->save();
    }
}
