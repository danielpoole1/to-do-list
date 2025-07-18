<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MLP To-Do</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

{{--

Future features/improvements:
Incorporate React to make this have a SPA experience, reducing the need for page refreshes each time we interact.
Prevent duplicate tasks being added
Add pagination to the table of tasks

--}}

<body>
    <div class="container px-3 px-sm-4">
        <header>
            <div class="py-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" height="75">
            </div>
        </header>

        <main class="row justify-content-between gx-5 my-5">
            <form class="col-12 col-lg-4 pb-5" action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <input class="form-control mb-3" type="text" name="task_name" placeholder="Insert task name">
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </form>
            <div class="col-12 col-lg-8">
                <div class="bg-white border rounded-2 px-3 py-3 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Task</th>
                                <th style="width: 100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td class="{{ $task->completed ? 'text-decoration-line-through' : '' }}">
                                        {{ $task->name }}</td>
                                    <td>
                                        @if (!$task->completed)
                                            <div class="d-flex">
                                                <form action="{{ route('tasks.update', $task) }}" method="POST"
                                                    class="me-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-success task-button"
                                                        title="Mark complete">&#10003;</button>
                                                </form>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger task-button"
                                                        title="Delete task">&#10005;</button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No tasks yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <footer class="mt-5">
            <div class="py-5 text-center text-secondary">Copyright &copy; {{ date('Y') }} All Rights Reserved</div>
        </footer>
    </div>
</body>

</html>
