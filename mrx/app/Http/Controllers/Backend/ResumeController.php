<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    function experiencePage(){

        return view('backend.pages.resume.experience');

    }
    function experienceList(Request $request){

        return Experience::latest()->get();
    }

    function createExperience(Request $request){


         Experience::create([
            'duration'=>$request->input('duration'),
            'title'=>$request->input('duration'),
            'designation'=>$request->input('designation'),
            'details'=>$request->input('details'),

        ]);

        return response()->json([
            "status"=> "ok"
        ]);
    }

    function experienceById(Request $request){
        $experience_id=$request->input('id');

        return Experience::where('id',$experience_id)->first();
    }

    function experienceUpdate(Request $request){
        $experience_id=$request->input('id');
        return Experience::where('id',$experience_id)->update([
            'duration'=>$request->input('update_duration'),
            'title'=>$request->input('update_title'),
            'designation'=>$request->input('update_designation'),
            'details'=>$request->input('update_details')
        ]);
    }


    function experienceDelete(Request $request){
        $experience_id=$request->input('id');
        return Experience::where('id',$experience_id)->delete();
    }

    

}
