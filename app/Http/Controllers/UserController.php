<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers(){
        $users = DB::table('users')
                    ->join('positions','users.position_id','=','positions.id')
                    ->select('users.*', 'positions.name as position')
                    ->get();
        return response()->json($users,200);
    }

    public function getUser($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'User not found',404]);
        }
        return response()->json($user);
    }

    public function addUser(Request $request){
        $user = User::create($request->all());
        return response($user, 201);
    }

    public function deleteUser(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'User not found',404]);
        }
        $user->delete();
        return response()->json(null,204);
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'User not found',404]);
        }
        $user->update($request->all());
        return response($user, 200);
    }
}
