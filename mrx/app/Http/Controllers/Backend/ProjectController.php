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

 
    public function createproject(Request $request)
    {
        // Get files from the request using the field names from   form
        $preImg_file = $request->file('previewLink');
        $thmImg_file = $request->file('thumbnailLink');

        // Define upload destinations
        $uploadPath = 'uploads/project/';

        // Move and store the uploaded files
        $preImg_fileName = hexdec(uniqid()) . '.' . $preImg_file->getClientOriginalExtension();
        $preImg_file->move(public_path($uploadPath), $preImg_fileName);
        $preImg_filePath = $uploadPath . $preImg_fileName;

        $thmImg_fileName = hexdec(uniqid()) . '.' . $thmImg_file->getClientOriginalExtension();
        $thmImg_file->move(public_path($uploadPath), $thmImg_fileName);
        $thmImg_filePath = $uploadPath . $thmImg_fileName;

        // Save To Database
        Project::create([
            'title' => $request->input('title'),
            'thumbnailLink' => $thmImg_filePath,
            'previewLink' => $preImg_filePath,
            'details' => $request->input('details'),
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Created successfully'
        ], 201);
    }
}
