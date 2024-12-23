@extends('layouts.app')
@section('title')
    Task List of {{ count($tasks) }} Task :
    <hr>
@endsection

@section('content')
    <nav class="mb-4 mt-4">
        <a href="{{ route('tasks.create') }}" class="font-meduim text-gray-700 underline decoration-pink-500">Add New Task</a>
    </nav>
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', $task->id) }}" @class([
                'font-bold',
                'font-thin line-through text-green-500' => $task->complete,
            ])>{{ $task->title }}</a>
            <br>
        </div>
    @empty
        <p>There are no tasks!!</p>
    @endforelse

    @if ($tasks->count())
        <div>
            {{ $tasks->links() }}
        </div>
    @endif
@endsection
