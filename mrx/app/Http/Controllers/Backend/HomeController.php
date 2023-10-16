<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use App\Models\HeroProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{

    // //=================hero method start==================
    // ====================================================
    function heroPage(){
       return view('backend.pages.home.hero');
    }

    function herodata(Request $request){
        $herodata=  DB::table('heroproperties')->first();

        return response()->json([
            'status' => 'success',
            'message' =>'Request Successful',
            'data' => $herodata,
        ],200);
    }

    public function updateHero(Request $request)
    {


        $id=$request->input('id');

        if ($request->hasFile('img')) {

            // Upload New File
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$t}-{$file_name}";
            $img->move(public_path('uploads'),$img_name);

            $img_url="uploads/{$img_name}";

            // Delete Old File
            $filePath=$request->input('img_path');
            File::delete($filePath);

            // Update

            HeroProperty::where('id',$id)->update([

                'key_line'=>$request->input('key_line'),
                'title'=>$request->input('title'),
                'short_title'=>$request->input('short_title'),
                'img'=>$img_url
            ]);

            return response()->json([
                'status' => 'ok',
                'message' =>'Request Successful'
            ],200);


        } else {
              HeroProperty::where('id',$id)->update([
                'key_line'=>$request->input('key_line'),
                'title'=>$request->input('title'),
                'short_title'=>$request->input('short_title'),
            ]);

            return response()->json([
                'status' => 'ok',
                'message' =>'Request Successful'
            ],200);
        }




}

// //=================hero method end==================
    // ====================================================

    // //=================about method start==================
 // ====================================================
function aboutPage(){
    return view('backend.pages.home.about');
 }

 function aboutdatashow(Request $request){
    $aboutdata=  DB::table('abouts')->first();

    return response()->json([
        'status' => 'success',
        'message' =>'Request Successful',
        'data' => $aboutdata,
    ],200);
}



public function updateAbout(Request $request) {
     return About::first()->update([
        'title'=> $request->input('title'),
        'details'=> $request->input('details'),
    ]);



}
  // //=================about method end==================
 // ====================================================
}
