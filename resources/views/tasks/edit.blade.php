@extends('layouts.wrapper')
@section('content')
    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ $task->description }}</textarea>
        </div>
        <div>
            <label for="completed">Completed</label>
            <select name="completed" id="completed">
                <option value="0" {{ $task->completed ? '' : 'selected' }}>No</option>
                <option value="1" {{ $task->completed ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection