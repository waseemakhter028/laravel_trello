<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Task;
#get external validation request
use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\SaveTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\StatusTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetTaskRequest $request)
    {
        #i am using relationship to find board all boards
        # or you can use normal query
        $tasks = Board::find($request->input('board_id'))->tasks;

        return $this->sendSuccess($tasks,"Tasks Retrived Successfully!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task,SaveTaskRequest $request)
    {
       /*
        checking task name already taken for same board
        showing error message
       */
       $taskCheck      = Task::select('name')->where(['name'=>$request->name,'board_id'=>$request->board_id])->first();
       if(!empty($taskCheck))
       return $this->sendError("Task name already taken");

        $task->name     = $request->name;
        $task->board_id = $request->board_id;
        $task->save();
        return $this->sendSuccess("Saved","Task Saved Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $this->sendSuccess($task,"Task Retrived Successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        /*
        checking task already taken for same board 
        showing error message
       */
       $taskCheck      = Task::select('name')->where('id','!=',$task->id)->where(['name'=>$request->name,'board_id'=>$task->board_id])->first();
       if(!empty($taskCheck))
       return $this->sendError("Task name already taken");

        $task->name    = $request->name;
        $task->save();
        return $this->sendSuccess($task,"Task Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return $this->sendSuccess("Deleted","Task Deleted Successfully!");
    }

    public function changeTaskStatus(StatusTaskRequest $request)
    {
        //task status change To Do / Doing / Done 
        // according to trello
        $task            = Task::find($request->id);
        $task->status    = $request->status;
        $task->save();
        
        return $this->sendSuccess($task,"Task Status Updated Successfully!");
    }
}
