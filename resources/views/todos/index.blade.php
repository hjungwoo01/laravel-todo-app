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
            bottom: 20px;
            right: 20px;
            background-color: #6c63ff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .plus-button:hover {
            background-color: #5a54d1;
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
            @foreach ($todos->where('completed', false) as $todo)
                <div class="list-group-item task-item">
                    <div>
                        <input type="checkbox" onclick="toggleComplete({{ $todo->id }})" class="mr-2">
                        <a href="{{ route('todos.show', $todo->id) }}">{{ $todo->title }}</a>
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

        <h2 class="my-4 text-center">Completed Tasks</h2>
        <div class="list-group">
            @foreach ($todos->where('completed', true) as $todo)
                <div class="list-group-item task-item completed">
                    <div>
                        <input type="checkbox" onclick="toggleComplete({{ $todo->id }})" checked class="mr-2">
                        <a href="{{ route('todos.show', $todo->id) }}">{{ $todo->title }}</a>
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