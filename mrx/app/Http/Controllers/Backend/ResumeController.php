<?php

namespace App\Http\Controllers\Backend;

use App\Models\Language;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Models\ProfessionalSkill;
use App\Http\Controllers\Controller;

class ResumeController extends Controller
{
    //Experience methods start here
    function experiencePage(){

        return view('backend.pages.resume.experience');

    }
    function experienceList(Request $request){

        return Experience::latest()->get();
    }

    function createExperience(Request $request){


         Experience::create([
            'duration'=>$request->input('duration'),
            'title'=>$request->input('title'),
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

 //Experience methods end here


 //Education methods start here
 function educationPage(){

    return view('backend.pages.resume.education');

}

function educationList(Request $request){

    return Education::latest()->get();
}

function createEducation(Request $request){


    Education::create([
       'duration'=>$request->input('duration'),
       'title'=>$request->input('duration'),
       'institutionName'=>$request->input('institutionName'),
       'field'=>$request->input('field'),
       'details'=>$request->input('details'),

   ]);

   return response()->json([
       "status"=> "ok"
   ]);
}

function educationById(Request $request){
    $education_id=$request->input('id');

    return Education::where('id',$education_id)->first();
}

function educationUpdate(Request $request){
    $education_id=$request->input('id');
    return Education::where('id',$education_id)->update([
        'duration'=>$request->input('update_duration'),
        'title'=>$request->input('update_title'),
        'institutionName'=>$request->input('update_institutionName'),
        'field'=>$request->input('update_field'),
        'details'=>$request->input('update_details')
    ]);
}


function educationDelete(Request $request){
    $education_id=$request->input('id');
    return Education::where('id',$education_id)->delete();
}

 //Education methods end here



 //Skill methods start here
 function skillPage(){

    return view('backend.pages.resume.professional_skills');

}


function skillList(Request $request){

    return ProfessionalSkill::latest()->get();
}

function createskill(Request $request){


    ProfessionalSkill::create([
       'name'=>$request->input('name'),


   ]);

   return response()->json([
       "status"=> "ok"
   ]);
}


function skillById(Request $request){
    $skill_id=$request->input('id');

    return ProfessionalSkill::where('id',$skill_id)->first();
}

function skillUpdate(Request $request){
    $skill_id=$request->input('id');
    return ProfessionalSkill::where('id',$skill_id)->update([
        'name'=>$request->input('update_name'),

    ]);
}
function skillDelete(Request $request){
    $skill_id=$request->input('id');
    return ProfessionalSkill::where('id',$skill_id)->delete();
}

 //Education methods end here


 //Language methods start here
 function languagePage(){

    return view('backend.pages.resume.language');

}

function languageList(Request $request){

    return Language::latest()->get();
}

function createlanguage(Request $request){


    Language::create([
       'name'=>$request->input('name'),


   ]);

   return response()->json([
       "status"=> "ok"
   ]);
}


function languageById(Request $request){
    $skill_id=$request->input('id');

    return Language::where('id',$skill_id)->first();
}

function languageUpdate(Request $request){
    $skill_id=$request->input('id');
    return Language::where('id',$skill_id)->update([
        'name'=>$request->input('update_name'),

    ]);
}
function languageDelete(Request $request){
    $skill_id=$request->input('id');
    return Language::where('id',$skill_id)->delete();
}


 //Language methods end here
}
