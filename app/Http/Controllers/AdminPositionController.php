<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class AdminPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        return view('positions.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
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
            'salary' => 'required'
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')->with('success','Position created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = Position::find($id);
        if(is_null($position)){
            return redirect()->route('positions.index')->with('fail','Position misses');
        }
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::find($id);
        if(is_null($position)){
            return redirect()->route('positions.index')->with('fail','Position misses');
        }
        return view('positions.edit', compact('position'));
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
        $position = Position::find($id);
        $request->validate([
            'name' => 'required',
            'salary' => 'required'
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')->with('success','Position updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::find($id);
        if(is_null($position)){
            return redirect()->route('positions.index')->with('fail','Position misses');
        }
        $position->delete();
        return redirect()->route('positions.index')->with('success','Position deleted successfully');
    }
}
