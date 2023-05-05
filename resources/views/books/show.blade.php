@extends('layouts.app')

@section('content')


<div class="container py-5">

    <h1 class="mb-5">
        My book: {{ $book['title'] }}
    </h1>
    <div>
        @foreach($book->authors as $author)
            <span class="badge bg-warning">
                {{ $author->first_name }}
            </span>
        @endforeach
    </div>
    <div class="card p-3">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $book['isbn_code'] }}</h6>
            <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $book['pages'] }}</h6>
            <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $book['isAvailable'] }}</h6>
            <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $book['copies'] }}</h6>
            <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $book['genre']['name'] }}</h6>
            <div class="div">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('books.index') }}" class="btn btn-primary">Back to book list</a>
            </div>
        </div>
    </div>

</div>
    
@endsection