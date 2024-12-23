<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;

// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {}
// }

// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];

Route::get('/tasks', function () {
    $tasks = Task::latest()->paginate();
    return view('index', ['tasks' => $tasks]);
})->name('tasks.index');
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/task/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks->edit');

Route::get("/task/{task}", function (Task $task) {

    if (!$task) {
        abort(Response::HTTP_NOT_FOUND);
    }
    return view('show', ['task' => $task]);
})->name('tasks.show');


Route::post('\tasks', function (TaskRequest $request) {
    // $data = $request->validated();
    // $task = new Task();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', $task->id)
        ->with('success', 'Task create successfully!!!!!');
})->name('tasks.store');


Route::put('\tasks\{task}', function (Task $task, TaskRequest $request) {
    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();
    $task->update($request->validated());
    return redirect()->route('tasks.show', $task->id)
        ->with('success', 'Task Edit successfully!!!!!');
})->name('tasks.update');


Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Task ' . $task->title . ' delete success!');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task complete successfully!');
})->name('tasks.toggle-complete');
