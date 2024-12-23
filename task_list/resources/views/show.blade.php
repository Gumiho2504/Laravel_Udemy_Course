@extends('layouts.app')
@section('title')
    {{ $task->title }}
    <hr>
    <hr>
@endsection

@section('content')
    <nav class="mb-4 mt-4">
        <a href="{{ route('tasks.index') }}" class="link"><- Back to TaskList</a>
    </nav>

    <p class="mb-4 text-slate-700">{{ $task->description }}</p>
    @isset($task->long_description)
        <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
    @endisset
    <p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} .
        Updated {{ $task->updated_at->diffForHumans() }}</p>


    <div class="my-4">
        @if ($task->complete)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium text-red-500">Not Completed</span>
        @endif
    </div>

    <div class="flex gap-2">
        <a href="{{ route('tasks->edit', $task->id) }}"
            class="rounded-md px-2 py-1 font-medium shadow-sm ring-1 ring-slate-700/10 text-slate-700 hover:bg-slate-50">Edit</a>

        <form action="{{ route('tasks.toggle-complete', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit"
                class="rounded-md px-2 py-1 font-medium shadow-sm ring-1 ring-slate-700/10 text-slate-700 hover:bg-slate-50">
                Mark as {{ $task->complete ? 'not completed' : 'completed' }}
            </button>
        </form>

        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="rounded-md px-2 py-1 font-medium shadow-sm ring-1 ring-slate-700/10 text-slate-700 hover:bg-slate-50">Delete</button>
        </form>
    </div>
@endsection
