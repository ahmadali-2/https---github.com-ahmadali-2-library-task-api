<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Rack;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    public function add_book(Request $request){
        if(auth()->user()->type == "admin"){
        $validation = $request->validate([
            "rack_id"=> "required",
            "name" =>  "required",
            "author"=> "required",
            "published_year"=> "required",
        ]);

        if(count(Book::where("rack_id",$request->rack_id)->get()) < 10){
            Book::insert($request->all());
            return response()->json([
                "message" => "Book inserted successfully!",
            ],200);
        }else{
            return response()->json([
                "message" => "Rack is full!, MAX book-keeping limit is 10",
            ],200);
        }
    }else{
        return response()->json([
            "message" => "Unauthrized, because user can't act as an admin",
        ],400);
    }
    }

    public function update_book(Request $request , $id){
        if(auth()->user()->type == "admin"){

        $book = Book::find($id)->first();
        $data = array();
        $data["name"] = $request->name ? $request->name  : $book->name;
        $data["author"] = $request->author ? $request->author : $book->author;
        $data["published_year"] = $request->published_year ? $request->published_year : $book->published_year;

        $book->update($data);

        return response()->json([
            "message" => "Book updated successfully!",
        ],200);
    }else{
        return response()->json([
            "message" => "Unauthrized, because user can't act as an admin",
        ],400);
    }
    }

    public function search_book($keyword){
        $books = Book::where("name",$keyword)->orWhere("author",$keyword)->orWhere("published_year",$keyword)->get();
        return response()->json([
            "message" => "Search complete!",
            "data" => $books,
        ]);
    }
}
