<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use App\Models\Social;
use App\Models\HeroProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Testing\Fluent\Concerns\Debugging;

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

    public function aboutdatashow(Request $request){
        // $aboutdata = About::first();

        $aboutdata=  DB::table('abouts')->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $aboutdata,
        ], 200);
    }



    public function updateAbout(Request $request) {
        try {

            $title = $request->input('title');
            $details = $request->input('details');


            $about = About::first();

            if ($about) {

                $about->title = $title;
                $about->details = $details;
                $about->save();

                return response()->json([
                    'status' => 'ok',
                    'message' => 'About data updated successfully',
                    'data' => $about,
                ], 200);
            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'About data not found',
                ], 404);
            }
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating About data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }





  // //=================about method end==================
 // ====================================================

   // //=================social method start==================
 // ====================================================





    function socialLink(){
        return view('backend.pages.home.social');
    }



    function sociallinkData(Request $request){
        $socialdata=  DB::table('social_links')->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Request successful',
            'data' => $socialdata,
        ], 200);
    }



    public function updateSocialLink(Request $request) {

            return Social::first()->update([
                'twitterLink'=> $request->input('twitterLink'),
                'githubrLink'=> $request->input('githubrLink'),
                'linkedinLink'=> $request->input('linkedinLink'),
            ]);

    }

//    =================social method end==================
//  ====================================================












}
