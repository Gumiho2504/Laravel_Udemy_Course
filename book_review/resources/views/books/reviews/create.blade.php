@extends('layouts.app')
@section('content')
    <h1 class=" mb-10 text-2xl">Add Review</h1>
    <form method="POST" action="{{ route('books.reviews.store', $book) }}">
        @csrf
        <label for="review"></label>
        <input name="review" id='review' @required(true) class=" input mb-4"></input>
        <label for="rating">Rating</label>
        <select name='rating' id='rating' class=" input mb-4" required>
            <option value="">Select a Rating</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button type="submit" class=" btn">Add Review</button>
    </form>
@endsection
