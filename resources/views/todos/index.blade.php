<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .completed {
            text-decoration: line-through;
            color: #d3d3d3;
        }
        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        .task-item:hover {
            background-color: #f8f9fa;
        }
        .task-actions {
            display: flex;
            gap: 10px;
        }
        .plus-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #6c63ff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s, width 0.3s, height 0.3s, font-size 0.3s;
        }
        .plus-button:hover {
            background-color: #5a54d1;
            width: 65px;
            height: 65px;
            font-size: 30px;
        }
        .icon-button {
            background: none;
            border: none;
            color: inherit;
            font-size: inherit;
            cursor: pointer;
        }
        .icon-button:hover {
            color: #d9534f; /* for delete */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Todo List</h1>

        <div class="list-group mb-4">
            @foreach ($todos as $todo)
                @if (!$todo->completed)
                    <div class="list-group-item task-item">
                        <div>
                            <input type="checkbox" onclick="toggleComplete({{ $todo->id }})" class="mr-2">
                            <a href="{{ route('todos.show', $todo->id) }}">{{ $todo->title }}</a>
                            @if($todo->due_date)
                                <small class="text-muted">Due: {{ \Carbon\Carbon::parse($todo->due_date)->format('M d, Y') }}</small>
                            @endif
                        </div>
                        <div class="task-actions">
                            <a href="{{ route('todos.edit', $todo->id) }}" class="icon-button text-primary">✏️</a>
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-button text-danger">🗑️</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <h2 class="my-4 text-center">Completed Tasks</h2>
        <div class="list-group">
            @foreach ($completedTodos as $todo)
                <div class="list-group-item task-item completed">
                    <div>
                        <input type="checkbox" onclick="toggleComplete({{ $todo->id }})" checked class="mr-2">
                        <a href="{{ route('todos.show', $todo->id) }}">{{ $todo->title }}</a>
                        @if($todo->completed_at)
                            <small class="text-muted">Completed: {{ \Carbon\Carbon::parse($todo->completed_at)->format('M d, Y') }}</small>
                        @endif
                    </div>
                    <div class="task-actions">
                        <a href="{{ route('todos.edit', $todo->id) }}" class="icon-button text-primary">✏️</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-button text-danger">🗑️</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="plus-button" onclick="location.href='{{ route('todos.create') }}'">+</button>
    </div>

    <script>
        function toggleComplete(id) {
            fetch(`/todos/${id}/toggle`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                location.reload();
            });
        }
    </script>
</body>
</html>