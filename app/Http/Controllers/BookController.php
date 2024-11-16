<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index() { 
        $data['books'] = Book::all();
        return view('books.index', $data);
    }

    function create(){
        $data["bookshelves"] = Bookshelf::pluck("name", "id");
        return view("books.create", $data);
    }

    function store(Request $request){
        $validate = $request-> validate([
        "title" => "require|max:255",
        "author" => "require|max:255",
        "year" => "require|max:2077",
        "publisher" => "require|max:255",
        "city" => "require|max:50",
        "cover" => "require",
        "bookshelf_id" => "require|max:5",
        ]);
        if($request->hasFile("cover")){
            $path = $request->file("cover")->storeAs(
                'public/cover_buku',
                'cover_buku_'.time().".".$request->file('cover')->extension()
            );
            $validate['cover'] = basename($path);
        }
        $book = Book::create($validate);
        if($book){
            $notification[] = [
                'message' => 'data buku berhasil disimpan',
                'alert-type' => 'success'
            ];
        }
        else{
            $notification[] = [
                'message' => 'data buku gagal disimpan',
                'alert-type' => 'error'
            ];
        }
        return redirect()->route('book')->with($notification);
    }

    public function edit(string $id){
        $data['book'] = Book::findOrFail($id);
        $data['bookshelves'] = Bookshelf::pluck("name", "id");
        return view("books.edit", $data);
    }

    public function update(Request $request, string $id){
        $book = Book::findOrFail($id);
        $validate = $request-> validate([
            "title" => "require|max:255",
            "author" => "require|max:255",
            "year" => "require|max:2077",
            "publisher" => "require|max:255",
            "city" => "require|max:50",
            "cover" => "require",
            "bookshelf_id" => "require|max:5",
            ]);
            if($request->hasFile("cover")){
                if($book->cover != null){
                    Storage::delete('public/cover_buku/'.$request->old_cover);
                }
                $path = $request->file("cover")->storeAs(
                    'public/cover_buku',
                    'cover_buku_'.time().".".$request->file('cover')->extension()
                );
                $validate['cover'] = basename($path);
            }
            $book = Book::create($validate);
            if($book){
                $notification[] = [
                    'message' => 'data buku berhasil disimpan',
                    'alert-type' => 'success'
                ];
            }
            else{
                $notification[] = [
                    'message' => 'data buku gagal disimpan',
                    'alert-type' => 'error'
                ];
            }
            return redirect()->route('book')->with($notification);
    }
    public function destroy(string $id){
        $book = Book::findOrFail($id);
        Storage::delete('public/cover_buku/'.$book->cover);
        $book->delete();
        $notification[] = array(
             'message' => 'data buku gagal disimpan',
            'alert-type' => 'error'
        );
           
        return redirect()->route('book')->with($notification);
    }
}
