<table class="table table-bordered" id="tasksTable" role="table">
    <thead>
        <tr>
            <th style="width: 10px" scope="col">#</th>
            <th scope="col">Task Name</th>
            <th scope="col">Project</th>
            <th scope="col">Priority</th>
            <th scope="col">Status</th>
            <th scope="col">Due Date</th>
            <th scope="col">Created</th>
            <th scope="col">Last Updated</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody id="sortableTaskBody">
        @foreach ($tasks as $tkey => $task)
        <tr class="align-middle" data-id="{{ $task->id }}">
            <td class="drag-handle" style="cursor: move;">{{ $tasks->firstItem() + $tkey }}</td>
            <td>{{ $task->task_name }}</td>
            <td>{{ $task->name ?? 'N/A' }}</td>
            <td>{{ $task->priority }}</td>
            <td>
                @if ($task->status == 'ToDo')
                    <span class="badge text-bg-warning">ToDo</span>
                @elseif ($task->status == 'In-Progress')
                    <span class="badge text-bg-info">In-Progress</span>
                @elseif ($task->status == 'Done')
                    <span class="badge text-bg-success">Done</span>
                @endif
            </td>
            <td>@if (!empty($task->due_date))
                    {{ date('Y-m-d', strtotime($task->due_date)) }}
                @endif
            </td>
            <td>{{ date('Y-m-d H:i', strtotime($task->created_at)) }}</td>
            <td>{{ date('Y-m-d H:i', strtotime($task->updated_at)) }}</td>
            <td class="nowrapcell">
                <a href="{{ url('tasks/edittask/'.$task->id) }}" class="btn btn-sm text-bg-primary"><i
                        class="bi bi-pencil"></i></a>
                &nbsp;
                <button class="btn btn-sm text-bg-danger btnDeleteTask" data-id="{{ $task->id }}"><i
                        class="bi bi-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="paginationLinks">
    {{ $tasks->links('pagination::bootstrap-5') }}
</div>