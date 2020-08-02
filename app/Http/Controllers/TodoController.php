<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todo = Auth::user()->todo()->get();

        return response()->json(['status' => 'success','result' => $todo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            "status_id"=> 'required',
            "category" => "required",
            "date_time" => "nullable",
            "user_id"=>"required"
        ]);
        if(Auth::user()->todo()->Create($request->all())){

            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::where('id', $id)->get();

        return response()->json($todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::where('id', $id)->get();

        return view('todo.edittodo',['todos' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            "status_id"=> 'required',
            "category" => "required",
            "date_time" => "nullable",
            "user_id"=>"required"
        ]);

        $todo = Todo::find($id);

        if($todo->fill($request->all())->save()){
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Todo::destroy($id)){
            return response()->json(['status' => 'success']);
        }
    }

    public function filterByStatus($task_status_id){
        $tasks = Todo::where('status_id',$task_status_id)
            ->get();
        return response()->json(['tasks' => $tasks]);
    }
}
