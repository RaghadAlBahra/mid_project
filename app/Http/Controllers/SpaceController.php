<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpaceRequest;
use App\Models\Center;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
        public function index(){
        $spaces = Space::with('center')->get();
        return view('admin.spaces.index',compact('spaces'));
    }

    public function create(){
        $centers = Center::all();
        return view('admin.spaces.create', compact('centers'));
    }

    public function store(StoreSpaceRequest $request){
         Space::query()->create($request->validated());
        return redirect()->route('spaces.index')->with('success','space created successfully');
    }

    public function show(Space $space){
        $space->load('center');
        return view('admin.spaces.show',compact('space'));
    }

    public function edit(Space $space){
        $centers = Center::all();
        return view('admin.spaces.edit',compact('space','centers'));
    }

    public function update(StoreSpaceRequest $request,Space $space){
        $space->update($request->validated());
        return redirect()->route('spaces.index')->with('success','Spaces updated successfully');
    }

    public function destroy(Space $space){
        $space->delete();
        return redirect()->route('spaces.index')->with('success','Spaces Deleted Successfully');
    }
}
