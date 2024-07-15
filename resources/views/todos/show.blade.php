<!DOCTYPE html>
<html>
<head>
    <title>Todo Details</title>
</head>
<body>
    <h1>Todo Details</h1>
    <p>Title: {{ $todo->title }}</p>
    <p>Description: {{ $todo->description }}</p>
    <p>Completed: {{ $todo->completed ? 'Yes' : 'No' }}</p>
    <a href="{{ route('todos.index') }}">Back to List</a>
</body>
</html>