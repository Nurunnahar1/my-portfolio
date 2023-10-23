<?php

namespace App\Http\Controllers\Backend;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

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
    function projectById(Request $request){
        $project_id=$request->input('id');

        return Project::where('id',$project_id)->first();
    }



    public function updateProject(Request $request) {

        $id = $request->input('id');

        if ($request->hasFile('update_thumbnailLink') || $request->hasFile('update_previewLink')) {

            // -------thumbnailLink
            $thumb_file = request()->file('update_thumbnailLink');
            $thumb_fileName = hexdec(uniqid()) . '.' . $thumb_file->getClientOriginalExtension();
            $thumb_file->move(public_path('/uploads/project'), $thumb_fileName);
            $thumb_filePath = "uploads/project/{$thumb_fileName}";

            //--------- previewLink
            $prev_file = request()->file('update_previewLink');
            $prev_fileName = hexdec(uniqid()) . '.' . $prev_file->getClientOriginalExtension();
            $prev_file->move(public_path('/uploads/project'), $prev_fileName);
            $prev_filePath = "uploads/project/{$prev_fileName}";

            // Delete Old File
            $delete_thumb_filePath = $request->input('thumb_filePath');
            File::delete($delete_thumb_filePath);

            $delete_filePath = $request->input('prev_filePath');
            File::delete($delete_filePath);

            // Update

            return Project::where('id', $id)->update([
                'title' => $request->input('title'),
                'thumbnailLink' => $thumb_filePath,
                'previewLink' => $prev_filePath,
                'details' => $request->input('details'),
            ]);

        } else {
            return Project::where('id', $id)->update([
                'key_line' => $request->input('key_line'),
                'title' => $request->input('title'),
                'short_title' => $request->input('short_title'),
            ]);
        }

    }




    function projectDelete(Request $request){
        $project_id=$request->input('id');
        return Project::where('id',$project_id)->delete();
    }



}
