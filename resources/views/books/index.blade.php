@extends('layouts.app')

@section('content')

<div class="container">

    <div class="title-wrapper py-5">
        <h1 class="mb-3">
            my library
        </h1>

        <a href="{{ route('books.create') }}" class="btn btn-primary">
            Crea nuovo 
        </a>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">isbn_code</th>
                <th scope="col">title</th>
                <th scope="col">authors</th>
                <th scope="col">pages</th>
                <th scope="col">is available</th>
                <th scope="col">copies</th>
                <th scope="col">genre</th>
                <th scope="col">created</th>
                <th scope="col">deleted</th>
                <th scope="col">actions</th>
            </tr>
        </thead>
    
        <tbody>
    
            @foreach ($books as $key=>$book)
    
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->isbn_code }}</td>
                <td><a href="{{ route('books.show', $book) }}">{{ $book->title }}</a></td>
                <td>
                    @foreach($book->authors as $author)
                        <span class="badge bg-warning">
                            {{ $author->first_name }}
                        </span>
                    @endforeach
                </td>
                <td>{{ $book->pages }}</td>
                <td>{{ $book->isAvailable }}</td>
                <td>{{ $book->copies }}</td>
                <td> {{ $book->genre->name }} </td>
                <td>{{ $book->created_at->format('Y-m-d') }}</td>
                <td>{{ $book->trashed() ? $book->deleted_at->format('Y-m-d') : '' }}</td>
                <td>
                    <div class="wrapper d-flex gap-1">

                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">edit</a>
                        <form action="{{ route('books.destroy', $book->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger btn-sm" value="delete">
                        </form>
    
                        <form action="{{ route('books.restore', $book->slug) }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-success btn-sm" value="restore">
                        </form>

                    </div>
                </td>
            </tr>
                
            @endforeach
    
        </tbody>
        
    </table>

</div>


    
@endsection