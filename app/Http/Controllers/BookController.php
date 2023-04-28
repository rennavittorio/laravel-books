<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = Book::withTrashed()->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $data = $request->validate([
            'isbn_code' => 'required|string',
            'title' => 'required|string|min:3|max:100',
            'main_author' => 'required|string|min:3|max:100',
            'pages' => 'nullable|numeric',
            'isAvailable' => 'required|boolean',
            'copies' => 'required|numeric'
        ]);

        $new_b = new Book();
        $new_b->fill($data);
        $new_b->slug = Str::of($data['title'])->slug();

        $new_b->save();

        return to_route('books.show', $new_b->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // dd($request);

        $data = $request->validate([
            'isbn_code' => 'required|string',
            'title' => 'required|string|min:3|max:100',
            'main_author' => 'required|string|min:3|max:100',
            'pages' => 'nullable|numeric',
            'isAvailable' => 'required|boolean',
            'copies' => 'required|numeric'
        ]);

        $book->update($data);
        return to_route('books.show', $book->slug);
    }


    public function restore(Book $book, Request $request)
    {
        if ($book->trashed()) {
            $book->restore();
            $request->session()->flash('message', 'il libro è stato ripristinato nel db');
        };

        return to_route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->trashed()) {
            $book->forceDelete();
        }

        $book->delete();

        return to_route('books.index');
    }
}
