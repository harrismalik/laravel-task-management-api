@extends('layouts.wrapper')
@section('content')
    <h1>Create Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <label for="completed">Completed</label>
            <select name="completed" id="completed">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <button type="submit">Create</button>
    </form>
@endsection