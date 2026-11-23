<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCenterRequest;
use App\Models\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{


    public function index(){
        $centers = Center::all();
        return view('admin.centers.index',compact('centers'));
    }

    public function create(){
        return view('admin.centers.create');
    }

    public function store(StoreCenterRequest $request){
         Center::query()->create($request->validated());
        return redirect()->route('centers.index')->with('success','centers created successfully');
    }

    public function show(Center $center){
        $center->load('spaces');
        return view('admin.centers.show',compact('center'));
    }

    public function edit(Center $center){
        return view('admin.centers.edit',compact('center'));
    }

    public function update(StoreCenterRequest $request,Center $center){
        $center->update($request->validated());
        return redirect()->route('centers.index')->with('success','centers updated successfully');
    }

    public function destroy(Center $center){
        $center->delete();
        return redirect()->route('centers.index')->with('success','Center Deleted Successfully');
    }

    
}
