<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;

class TynUnController extends Controller
{
    public function index()
    {
        $types = Type::select("id", "name")->get();
        $units = Unit::select("id", "name")->get();

        $context = [
            "types" => $types,
            "units" => $units
        ];
        return view("admin.tynun", $context);
    }

    public function create(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);

        if($request->get("mode") == "type") {
            Type::create([
                "name" => $request->name
            ]);
        } else {
            Unit::create([
                "name" => $request->name
            ]);
        }

        return redirect()->route("admin.tynun.index");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required"
        ]);

        if($request->get("mode") == "type") {
            Type::where("id", $id)->update([
                "name" => $request->name
            ]);
        } else {
            Unit::where("id", $id)->update([
                "name" => $request->name
            ]);
        }

        return redirect()->route("admin.tynun.index");
    }

    public function delete(Request $request, $id)
    {
        if($request->get("mode") == "type") {
            $type = Type::find($id);
            $type->delete();
        } else {
            $unit = Unit::find($id);
            $unit->delete();
        }

        return redirect()->route("admin.tynun.index");
    }
}
