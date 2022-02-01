<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rack;
use Illuminate\Http\Request;

class RackApiController extends Controller
{
    public function add_rack(Request $request){
        if(auth()->user()->type == "admin"){
            $validation = $request->validate([
                "name" => "required",
            ]);

            Rack::insert($request->all());

            return response()->json([
                "message" => "Rack created successfully!",
            ],200);

        }else{
            return response()->json([
                "message" => "Unauthrized, because user can't act as an admin",
            ],400);
        }
    }

    public function update_rack(Request $request , $id){
        if(auth()->user()->type == "admin"){
            $validation = $request->validate([
                "name" => "required",
            ]);

            $data = array();
            $data["name"] = $request->name;
            Rack::find($id)->update($data);

            return response()->json([
                "message" => "Rack updated successfully!",
            ],200);

        }else{
            return response()->json([
                "message" => "Unauthrized, because user can't act as an admin",
            ],400);
        }
    }

    // with one to many relation
    public function all_racks(){
        $books = Rack::first()->books;
        return response()->json([
            "message" => "List of books",
            "data" => $books,
        ],200);
    }
}
