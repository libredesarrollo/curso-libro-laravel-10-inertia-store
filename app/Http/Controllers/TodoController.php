<?php


namespace App\Http\Controllers;

use Response;
use Validator;
use App\Models\Todo;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    public function index()
    {
        $prop_todos = Todo::where('user_id', auth()->id())->orderBy('count')->get();
        return inertia('Todo/Index', compact('prop_todos'));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => "required|min:2|max:255",
        ]);

        if ($validator->fails()) {
            return Response::json([
                'error' => $validator->errors()->get('name')[0]
            ], 400);
        }

        // $data = $request->validate(
        //     [
        //         'name' => "required|min:2|max:255",
        //     ]
        // );

        $todo = Todo::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'count' => Todo::where('user_id', auth()->id())->count()
        ]);

        return response()->json($todo);

        //return back();
    }

    public function update(Todo $todo, Request $request)
    {
        $data = $request->validate(
            [
                'name' => "required|min:2|max:255",
            ]
        );

        Todo::where("id", $todo['id'])->where('user_id', auth()->id())->update(['name' => $data['name']]);
        return back();
    }
    public function destroy(Todo $todo = null)
    {  
        if ($todo == null)
            Todo::where('user_id', auth()->id())->delete();
        else
            Todo::where('user_id', auth()->id())->where('id', $todo->id)->delete();
        return back();
    }

    public function status(Todo $todo = null)
    {
        Todo::where("id", $todo->id)->where('user_id', auth()->id())->update(['status' => request('status') == '1']);
        return back();
    }
    public function orden()
    {
        foreach (request('ids') as $count => $id) {
            Todo::where('user_id', auth()->id())->where("id", $id)->update(['count' => $count]);
        }
    }

}