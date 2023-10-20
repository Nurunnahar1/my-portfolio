<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function projectPage(){
        return view('backend.pages.project.project');
     }

     function projectList(Request $request){

        return Project::latest()->get();
    }

}
