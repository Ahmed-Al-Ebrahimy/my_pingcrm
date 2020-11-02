<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getUsers(Request $request, User $ser)
{
    $input = \Arr::except($request->all(),array('_token', '_method'));

    $data = User::where('is_active', '1');
    if(isset($input['username'])) {
        $data = $data->where('username', 'like', '%'.$input['username'].'%');
    }
    if(isset($input['country'])) {
        $data = $data->where('country', $input['country']);
    }
    $data = $data->get();
    return \DataTables::of($data)
        ->addColumn('Actions', function($data) {
            return '<button type="button" data-id="'.$data->id.'" data-toggle="modal" data-target="#DeleteUserModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
        })
        ->rawColumns(['Actions'])
        ->make(true);
}
}
