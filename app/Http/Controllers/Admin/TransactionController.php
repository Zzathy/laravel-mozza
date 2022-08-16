<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $created = DB::table("transactions")->distinct()->pluck("created_at");
        $count = count($created);

        if($created->isEmpty()) {
            $transactions = [];
        } else {
            for($i = 0; $i < $count; $i++) {
                $transactions[] = Transaction::where("created_at", $created[$i])->get();
            }
        }

        $count += 1;

        $context = [
            "count" => $count,
            "transactions" => $transactions
        ];

        return view("admin.transaction", $context);
    }
    public function create(Request $request)
    {
        for($i = 0; $i < count($request->item); $i++) {
            $item = Item::find($request->item[$i]);

            if($i == 0 && $request->discount != null) {
                $discount = $request->discount;
            } else {
                $discount = 0;
            }

            Transaction::create([
                "code" => $request->code,
                "quantity" => $request->quantity[$i],
                "item" => $request->item[$i],
                "discount" => $discount,
                "total" => $item->sell_price * $request->quantity[$i]
            ]);

            $item->stock -= $request->quantity[$i];
            $item->save();
        }

        return redirect()->route("admin.transaction.index");
    }
    public function update(Request $request, Transaction $transaction)
    {
        if($request->isMethod("post")) {
            //
        } else {
            //
        }
    }
    public function destroy(Transaction $transaction)
    {
        //
    }
}
