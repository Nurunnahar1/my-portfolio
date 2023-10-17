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

    public function aboutdatashow(Request $request){
        // $aboutdata = About::first();

        $aboutdata=  DB::table('abouts')->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $aboutdata,
        ], 200);
    }



    // public function updateAbout(Request $request) {

    //     $aboutdataupdate =  About::first()->update([
    //         'title'=> $request->input('title'),
    //         'details'=> $request->input('details'),
    //     ]);
    //     return response()->json([
    //         'status' => 'ok',
    //         'message' =>'Request Successful',
    //         'data' => $aboutdataupdate,
    //     ],200);




    // }




  // //=================about method end==================
 // ====================================================

   // //=================social method start==================
 // ====================================================



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


// function updateSocialLink(Request $request,$id){
//    try{
//         $twitterLink = $request->input('twitterLink');
//         $linkedinLink = $request->input('linkedinLink');
//         $githubrLink = $request->input('githubrLink');

//          $social_links = DB::table('social_links')->first();

//          if($social_links){
//             $social_links->twitterLink = $twitterLink;
//             $social_links->linkedinLink =$linkedinLink;
//             $githubrLink->githubrLink =$githubrLink;
//             $social_links->save();


//             return response()->json([
//                 'status' => 'ok',
//                 'message' => 'social_links data updated successfully',
//                 'data' => $social_links,
//             ], 200);
//          }else {

//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'social_links data not found',
//             ], 404);
//         }
//    }catch (\Exception $e){
//         return response()->json([
//             'status' => 'error',
//             'message' => 'An error occurred while updating About data',
//             'error' => $e->getMessage(),
//         ], 500);
//    }
// }

   // //=================social method end==================
 // ====================================================




 public function updateSocialLink(Request $request)
 {
     try {
         $twitterLink = $request->input('twitterLink');
         $linkedinLink = $request->input('linkedinLink');
         $githubrLink = $request->input('githubrLink');

         $social_links = DB::table('social_links')->first();

         if ($social_links) {
             DB::table('social_links')->update([
                 'twitterLink' => $twitterLink,
                 'linkedinLink' => $linkedinLink,
                 'githubrLink' => $githubrLink,
             ]);

             return response()->json([
                 'status' => 'ok',
                 'message' => 'Social links data updated successfully',
                 'data' => $social_links,
             ], 200);
         } else {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Social links data not found',
             ], 404);
         }
     } catch (\Exception $e) {
         return response()->json([
             'status' => 'error',
             'message' => 'An error occurred while updating social links data',
             'error' => $e->getMessage(),
         ], 500);
     }
 }








}
