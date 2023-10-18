<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    function experiencePage(){

        return view('backend.components.experience.index' );

    }
    function experienceList(Request $request){
        $id=$request->header('id');
        return Experience::where('id',$id)->get();
    }
}
