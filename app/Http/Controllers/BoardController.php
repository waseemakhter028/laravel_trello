<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
#loading models
use App\User;
use App\Board;
#get external validation request
use App\Http\Requests\GetBoardRequest;
use App\Http\Requests\SaveBoardRequest;
use App\Http\Requests\UpdateBoardRequest;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetBoardRequest $request)
    {
        #i am using relationship to find user all boards
        # or you can use normal query

        $boards = User::find($request->input('user_id'))->boards;

        return $this->sendSuccess($boards,"Boards Retrived Successfully!");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Board $board,SaveBoardRequest $request)
    {
       /*
        checking title already taken for same user 
        showing error message
       */    
       $boardCheck      = Board::select('title')->where(['title'=>$request->title,'user_id'=>$request->user_id])->first();
       if(!empty($boardCheck))
       return $this->sendError("Board title already taken");

       $board->title    = $request->title;
       $board->user_id  = $request->user_id;
       $board->save();

       return $this->sendSuccess("Saved","Board Saved Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        return $this->sendSuccess($board,"Board Retrived Successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
       /*
        checking title already taken for same user 
        showing error message
       */
       $boardCheck      = Board::select('title')->where('id','!=',$board->id)->where(['title'=>$request->title,'user_id'=>$board->user_id])->first();
       if(!empty($boardCheck))
       return $this->sendError("Board title already taken");

        $board->title    = $request->title;
        $board->save();
        return $this->sendSuccess($board,"Board Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $board->delete();
        return $this->sendSuccess("Deleted","Board Deleted Successfully!");
    }
}
