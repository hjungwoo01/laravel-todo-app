<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
</head>
<body>
    <h1>Todo List</h1>
    <a href="{{ route('todos.create') }}">Create New Todo</a>
    <ul>
        @foreach ($todos as $todo)
            <li>
                <a href="{{ route('todos.show', $todo->id) }}">{{ $todo->title }}</a> -
                <a href="{{ route('todos.edit', $todo->id) }}">Edit</a> -
                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
</body>
</html>