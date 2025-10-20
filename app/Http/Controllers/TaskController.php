<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    //Start - Code Tasks

    // Dashboard
    public function dashboard()
    {
        $data['tasks'] = Task::join('projects', 'tasks.project_id', '=', 'projects.id')
            ->orderBy('priority', 'asc')
            ->select(['tasks.*', 'projects.name'])
            ->paginate(env('TASKS_PER_PAGE', 10));
            // ->get(['tasks.*', 'projects.name']); //before paginate()
        $projectModel = new Project();
        $data['projects'] = $projectModel->getProjects();
        // echo "<pre>"; print_r($data);exit;
        return view('tasks.dashboard', $data);
    }
    
    // Show list of tasks
    public function index()
    {
        $data['tasks'] = Task::join('projects', 'tasks.project_id', '=', 'projects.id')
            ->orderBy('priority', 'asc')
            ->select(['tasks.*', 'projects.name'])
            ->paginate(env('TASKS_PER_PAGE', 10));
            // ->get(['tasks.*', 'projects.name']); //before paginate()
        $projectModel = new Project();
        $data['projects'] = $projectModel->getProjects();
        // echo "<pre>"; print_r($data);exit;
        return view('tasks.index', $data);
    }

    // Show paginated tasks
    public function paginateTasks(Request $request)
    {
        if ($request->ajax()) {
            $query = Task::join('projects', 'tasks.project_id', '=', 'projects.id')
                ->select(['tasks.*', 'projects.name'])
                ->orderBy('priority', 'asc');
                        //  ->get(['tasks.*', 'projects.name']); //before paginate()
            // apply filter if selected
            if ($request->filled('project_id') && $request->project_id != 'all') {
                $query->where('tasks.project_id', $request->project_id);
            }
            if ($request->filled('search_key') && $request->search_key != '') {
                $query->where('tasks.task_name', 'like', '%'.$request->search_key.'%');
            }
            $tasks = $query->paginate(env('TASKS_PER_PAGE', 10));
            // echo "<pre>"; print_r($data);exit;
            return view('tasks.partials.tasks_table', compact('tasks'))->render();
        }
        abort(404);
    }

    public function addTaskForm()
    {
        $projectModel = new Project(); 
        $data['projects'] = $projectModel->getProjects();
        return view('tasks.addtask', $data);
    }

    public function store(Request $request)
    {
        // echo "<pre>"; print_r($_POST);exit;
        $request->validate([
            'task_name' => 'required',
            'project' => 'required',
            'task_duedate' => 'nullable|date_format:Y-m-d',
        ]);
        $maxPriority = Task::max('priority') ?? 0;
        Task::create([
            'task_name'     => $request->task_name,
            'project_id'    => $request->project,
            'priority'      => $maxPriority + 1,
            'status'        => $request->task_status,
            'due_date'      => $request->task_duedate,
        ]);
        return redirect('/tasks')
                    ->with('success', 'Task '.$request->task_name.' has been added successfully');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['task_name' => 'required']);
        $task->update(['task_name' => $request->task_name]);
        return back();
    }

    public function editTask(Request $request, $tid)
    {
        if(isset($_POST['task_name']) && !empty(trim($_POST['task_name']))) {
            $request->validate([
                'task_name' => 'required',
                'project' => 'required',
                'task_duedate' => 'nullable|date_format:Y-m-d',
            ]);
            $newTask = trim($request->input('task_name'));
            $project = (int) trim($request->input('project'));
            if(!empty($newTask) && !empty($project)) {
                $fUpdateData = [
                    'task_name'     => $newTask,
                    'project_id'    => $project,
                    'status'        => $request->task_status,
                    'due_date'      => $request->task_duedate,
                ];
                Task::where('id', $tid)->update($fUpdateData);
                return redirect('/tasks')
                    ->with('success', 'Task '.$newTask.' has been updated successfully');
            }
        }

        $projectModel = new Project(); 
        $data['projects'] = $projectModel->getProjects();
        $data['task'] = Task::where('id', $tid)
            ->get()->toArray();
        // echo "<pre>"; print_r($data);exit;
        return view('tasks.edittask', $data);
    }

    public function destroy($taskId)
    {
        try {
            $task = Task::findOrFail($taskId);
            $task->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully!'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Task not found!'
            ], 404);
        }
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order');

        if (empty($order)) {
            return response()->json(['error' => 'No order data received'], 400);
        }

        // Find the smallest current priority among these tasks
        $minPriority = \App\Models\Task::whereIn('id', $order)->min('priority');

        // Reassign new priorities based on new order
        foreach ($order as $index => $id) {
            \App\Models\Task::where('id', $id)->update(['priority' => $minPriority + $index]);
        }
        return response()->json(['status' => 'success']);
    }
    //End - Code Tasks

    //Start - Code Projects
    public function projects()
    {
        $projectModel = new Project(); 
        $data['projects'] = $projectModel->getProjects();
        return view('tasks.projects', $data);
    }

    public function addProject(Request $request)
    {
        $newProjectName = trim($request->input('projectName'));
        $request->validate([
            'projectName' => 'required|string|max:255',
        ]);

        if(!empty($newProjectName)) {
            if (Project::where('name', $newProjectName)->exists()) {
                return redirect('tasks/projects')
                    ->with('error', 'Project '.$newProjectName.' already exists');
            }
            else {
                Project::create([
                    'name' => $newProjectName,
                ]);
                return redirect('tasks/projects')
                    ->with('success', 'Project has been added successfully');
            }
            
        }
        else {
            return redirect('tasks/projects')
                    ->with('error', 'No data to insert');
        }
    }

    public function editProject(Request $request)
    {
        $projectName = trim($request->input('editProjectName'));
        $project_id = trim((int)$request->input('projectId'));
        $projectImage = null;

        $request->validate([
            'editProjectName' => 'required|string|max:255',
        ]);

        if(!empty($projectName)) {
            Project::where('id', $project_id)->update([
                'name' => $projectName,
            ]);
            return redirect('tasks/projects')
                ->with('success', 'Project has been updated successfully');
        }
        else {
            return redirect('tasks/projects')
                ->with('error', 'No data to update');
        }
    }

    public function deleteProject(Request $request)
    {
        $project_id = trim((int)$request->input('projectId'));
        if(!empty($project_id) && Project::where('id', $project_id)->exists()) {
            $projectData = Project::where('id', $project_id)->first();
            Project::where('id', $project_id)->delete();
            $jsonArr = [
                'status' => 'success',
                'message' => 'Project has been deleted successfully',
            ];
            return response()->json($jsonArr);
        }
        else {
            $jsonArr = [
                'status' => 'error',
                'message' => 'No data to delete',
            ];
            return response()->json($jsonArr);
        }
    }
    //End - Code Projects
}
