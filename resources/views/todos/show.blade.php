<!DOCTYPE html>
<html>
<head>
    <title>Todo Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }
        .btn-primary:hover {
            background-color: #5a54d1;
            border-color: #5a54d1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4 text-center">Todo Details</h1>
        <div class="mb-3">
            <strong>Title:</strong>
            <p>{{ $todo->title }}</p>
        </div>
        <div class="mb-4">
            <strong>Description:</strong>
            <p>{{ $todo->description }}</p>
        </div>
        <div class="mb-4">
            <strong>Due Date:</strong>
            @if($todo->due_date)
                <p>{{ \Carbon\Carbon::parse($todo->due_date)->format('M d, Y') }}</p>
            @else
                <p>No due date set</p>
            @endif
        </div>
        @if($todo->completed)
        <div class="mb-4">
            <strong>Completed Date:</strong>
            @if($todo->completed_at)
                <p>{{ \Carbon\Carbon::parse($todo->completed_at)->format('M d, Y') }}</p>
            @else
                <p>No completion date set</p>
            @endif
        </div>
        @endif
        <a href="{{ route('todos.index') }}" class="btn btn-primary btn-block">Back to List</a>
    </div>
</body>
</html>