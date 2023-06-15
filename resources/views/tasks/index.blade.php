@extends('layouts.wrapper')
@section('content')
    <h1>Task List</h1>
    <button type="button" onclick="window.location.href = '{{ route('tasks.create') }}'">Create New Task</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->completed ? 'Yes' : 'No' }}</td>
                    <td>
                        <button onclick="window.location.href = '{{ route('tasks.edit', $task) }}'">Edit</button>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Confirm to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection