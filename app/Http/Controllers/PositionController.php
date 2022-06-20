<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function getPositions(){
        return response()->json(Position::all(),200);
    }

    public function getPosition($id){
        $position = Position::find($id);
        if(is_null($position)){
            return response()->json(['message'=>'position not found',404]);
        }
        return response()->json($position);
    }

    public function addPosition(Request $request){
        $position = Position::create($request->all());
        return response($position, 201);
    }

    public function deletePosition(Request $request, $id){
        $position = Position::find($id);
        if(is_null($position)){
            return response()->json(['message'=>'position not found',404]);
        }
        $position->delete();
        return response()->json(null,204);
    }

    public function updatePosition(Request $request, $id){
        $position = Position::find($id);
        if(is_null($position)){
            return response()->json(['message'=>'position not found',404]);
        }
        $position->update($request->all());
        return response($position, 200);
    }
}
