@extends('layouts.app')
@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>
    <form method="GET" action="{{ route('books.index') }}" class="mb-4 flex items-center space-x-2 h-10">
        <input type="text" name="title" id="title" placeholder="Search by title" value="{{ request('title') }}"
            class="input">
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <button type="submit" class="btn h-10">Search</button>
        <a href="{{ route('books.index') }}" class="btn h-10">Clear</a>
    </form>


    <div class="filter-container">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6months' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
            ];
        @endphp
        @foreach ($filters as $filter => $label)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $filter]) }}"
                class="{{ request('filter') === $filter || (request('filter') === null && $filter === '') ? 'filter-item-active' : 'filter-item' }}">
                {{ $label }}
            </a>
        @endforeach
        {{-- <a href="{{ route('books.index') }}"
            class="filter-item {{ request('sort') == 'rating' ? 'filter-item-active' : '' }}">
            Rating
        </a>
        <a href="{{ route('books.index', ['sort' => 'review_count']) }}"
            class="filter-item {{ request('sort') == 'review_count' ? 'filter-item-active' : '' }}">
            Review Count
        </a> --}}

    </div>


    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', $book->id) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">by {{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                <x-star-rating :rating="$book->reviews_avg_rating" />
                                {{ number_format($book->reviews_avg_rating, 1) }}
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews->count() }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="#" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>
@endsection