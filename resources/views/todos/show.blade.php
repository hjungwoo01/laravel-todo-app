<!DOCTYPE html>
<html>
<head>
    <title>Todo Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>Todo Details</h1>
    <p>Title: {{ $todo->title }}</p>
    <p>Description: {{ $todo->description }}</p>
    <a href="{{ route('todos.index') }}">Back to List</a>
</body>
</html>