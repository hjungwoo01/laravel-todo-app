<!DOCTYPE html>
<html>
<head>
    <title>Edit Todo</title>
</head>
<body>
    <h1>Edit Todo</h1>
    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $todo->title }}" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ $todo->description }}</textarea>
        <label for="completed">Completed:</label>
        <select id="completed" name="completed" required>
            <option value="0" {{ !$todo->completed ? 'selected' : '' }}>No</option>
            <option value="1" {{ $todo->completed ? 'selected' : '' }}>Yes</option>
        </select>
        <button type="submit">Update</button>
    </form>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>