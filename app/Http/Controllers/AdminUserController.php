<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                    ->join('positions','users.position_id','=','positions.id')
                    ->select('users.*', 'positions.name as position')
                    ->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = DB::table('positions')
                        ->get();
        return view('users.create',compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'position_id'=> 'required',
        ]);
        DB::table('users')->insert(['name'=>$request->input('name'), 'email'=>$request->input('email'),'position_id'=>$request->input('position_id')]);
        return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')
                    ->join('positions','users.position_id','=','positions.id')
                    ->where('users.id','=',$id)
                    ->select('users.name as name','users.email as email', 'positions.name as position','positions.salary as salary')
                    ->first();
        if(is_null($user)){
            return redirect()->route('users.index')->with('fail','User misses');
        }
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')
                        ->join('positions','users.position_id','=','positions.id')
                        ->where('users.id','=',$id)
                        ->select('users.id as id','users.position_id as position_id','users.name as name','users.email as email', 'positions.name as position','positions.salary as salary')
                        ->first();
        if(is_null($user)){
            return redirect()->route('users.index')->with('fail','User misses');
        }
        $positions = DB::table('positions')
                        ->get();
        return view('users.edit',compact('user','positions'));
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
        $user = DB::table('users')
                    ->where('id',$id)
                    ->update(['name'=>$request->input('name'), 'email'=>$request->input('email'),'position_id'=>$request->input('position_id')]);
        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = DB::table('users')
                    ->where('id',$id)
                    ->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }
}
