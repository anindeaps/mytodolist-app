<?php

namespace App\Http\Controllers;
use App\Models\MyToDoList;
use Illuminate\Http\Request;

class MyToDoListController extends Controller
{
    public function index()
    {
        return MyToDoList::all();
    }

    public function store(Request $request)
    {
        $todo = MyToDoList::create($request->all());
        return response()->json($todo, 201);
    }

    public function update(Request $request, $id)
    {
        $todo = MyToDoList::findOrFail($id);
        $todo->update($request->all());
        return response()->json($todo, 200);
    }

    public function destroy($id)
    {
        MyToDoList::destroy($id);
        return response()->json(null, 204);
    }
}
