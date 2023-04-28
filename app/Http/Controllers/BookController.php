<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
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

        $genres = Genre::orderBy('name', 'asc')->get();
        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        // dd($request);

        $data = $request->validated();

        $new_b = new Book();
        $new_b->fill($data);
        $new_b->slug = Str::of($data['title'])->slug();

        if (!isset($data['isAvailable'])) {
            $new_b->isAvailable = 0;
        };

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

        $genres = Genre::orderBy('name', 'asc')->get();
        return view('books.edit', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // dd($request);

        $data = $request->validated();
        $data['slug'] = Str::of($data['title'])->slug();

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
            $book->forceDelete(); //hard
        }

        $book->delete(); //soft



        return to_route('books.index');
    }
}
