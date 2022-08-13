<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $items = DB::table("items")
                    ->join("types", "items.type", "=", "types.id")
                    ->join("units", "items.unit", "=", "units.id")
                    ->select("items.*", "types.name as type_name", "units.name as unit_name")
                    ->get();

        $types = Type::select("id", "name")->get();
        $units = Unit::select("id", "name")->get();

        $context = [
            "items" => $items,
            "types" => $types,
            "units" => $units
        ];
        return view("admin.item", $context);
    }

    public function create(Request $request)
    {
        $request->validate([
            "name" => "required",
            "type" => "required",
            "unit" => "required",
            "base_price" => "required",
            "sell_price" => "required",
            "stock" => "required"
        ]);

        Item::create([
            "name" => $request->name,
            "type" => $request->type,
            "unit" => $request->unit,
            "base_price" => $request->base_price,
            "sell_price" => $request->sell_price,
            "stock" => $request->stock
        ]);

        return redirect()->route("admin.item.index");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "type" => "required",
            "unit" => "required",
            "base_price" => "required",
            "sell_price" => "required",
            "stock" => "required"
        ]);

        Item::where("id", $id)->update([
            "name" => $request->name,
            "type" => $request->type,
            "unit" => $request->unit,
            "base_price" => $request->base_price,
            "sell_price" => $request->sell_price,
            "stock" => $request->stock
        ]);

        return redirect()->route("admin.item.index");
    }

    public function delete($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->route("admin.item.index");
    }
}
