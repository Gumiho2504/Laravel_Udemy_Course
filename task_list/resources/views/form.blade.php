@extends('layouts.app')
@section('title', isset($task) ? 'Edite Task id : ' : 'Create New Task :')

@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0, 8rem;
        }
    </style>
@endsection
@section('content')
    <div class="mt-4">

        <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
            @csrf
            @isset($task)
                @method('PUT')
            @endisset


            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name='title' id="title" @class(['border-red-500' => $errors->has('title')])
                    value="{{ $task->title ?? old('title') }}">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" @class(['border-red-500' => $errors->has('title')])>{{ $task->description ?? old('description') }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="long_description">Long Description</label>
                <textarea name="long_description" id="long_description" cols="30" rows="10"
                    class="@error('long_description')
                    border-red-500
                @enderror">{{ $task->long_description ?? old('long_description') }}</textarea>
                @error('long_description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn">
                    @isset($task)
                        Update Task
                    @else
                        Add Task
                    @endisset
                </button>
                <a href="{{ route('tasks.index') }}" class="btn">Cancel</a>
            </div>


        </form>
    </div>
@endsection
