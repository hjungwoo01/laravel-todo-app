<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
</head>
<body>
    <h1>Todo List</h1>
    <ul>
        @foreach ($todos as $todo)
            <li>{{ $todo->title }} - {{ $todo->description }}</li>
        @endforeach
    </ul>
</body>
</html>
