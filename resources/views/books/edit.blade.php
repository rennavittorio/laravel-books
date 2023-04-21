@extends('layouts.app')

@section('content')


<div class="container py-5">

    <h1 class="mb-5">
        new book
    </h1>

    <form class="row g-3" action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="col-12">
          <label for="isbn_code" class="form-label">isbn_code</label>
          <input type="text" class="form-control" id="isbn_code" name="isbn_code" value="{{ old('isbn_code', $book->isbn_code)}}">
        </div>
        @error('isbn_code')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="col-12">
            <label for="title" class="form-label">title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title)}}">
        </div>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="col-12">
            <label for="main_author" class="form-label">main_author</label>
            <input type="text" class="form-control" id="main_author" name="main_author" value="{{ old('main_author', $book->main_author)}}">
        </div>
        @error('main_author')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="col-12">
            <label for="pages" class="form-label">pages</label>
            <input type="number" class="form-control" id="pages" name="pages" value="{{ old('pages', $book->pages)}}">
        </div>
        @error('pages')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="col-12">
            <input @checked(old('isAvailable', $book->isAvailable)) type="checkbox" class="form-check-input" id="isAvailable" name="isAvailable">
            <label for="isAvailable" class="form-label">isAvailable</label>
        </div>
        @error('isAvailable')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="col-12">
            <label for="copies" class="form-label">copies</label>
            <input type="number" class="form-control" id="copies" name="copies" value="{{ old('copies', $book->copies)}}">
        </div>
        @error('copies')
            <div class="text-danger">{{ $message }}</div>
        @enderror


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update book</button>
        </div>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                {{-- $error->all() ci restituisce un array/collection, che cicla --}}
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
    
@endsection