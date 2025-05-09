<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Module;  
use App\Models\Content;
use Illuminate\Support\Facades\Validator;
class coursecontroller extends Controller
{
    public function index(){
        return view('Course.index');
    }

    public function store(Request $request){
        
         //dd($request->all());

    $validator = Validator::make($request->all(), [
    'title' => 'required|string',
    'feature_video' => 'required|string',
    'module_title' => 'required|array',
    'module_title.*' => 'required|string',
    'content' => 'required|array',
    'content.*' => 'required|array',
    'content.*.*.content_title' => 'required|string',
    'content.*.*.video_source_type' => 'required|string',
        'content.*.*.video_length' => [
            'nullable',
            'required_if:content.*.*.video_source_type,video', 
            'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', 
        ],
        'content.*.*.video_url' => [
            'nullable',
            'url', 
        ],
    ]);

    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }




        DB::beginTransaction();
            try{

                $course = new Course();
                $course->course_title = $request->title;
                $course->feature_video = $request->feature_video;
                $course->save();
                foreach($request->input('module_title',[]) as $index => $module_title){

                    $module = new Module();
                    $module->module_title = $module_title;
                    $module->course_id = $course->id;
                    $module->save();
                    $contents = $request->input("content.{$index}", []);
                    foreach($request->content[$index] as $contentItem){
                        $content = new Content();
                        $content->module_id = $module->id;
                        $content->content_title = $contentItem['content_title'];
                        $content->video_source_type = $contentItem['video_source_type'];
                        $content->content_video_url = $contentItem['video_url'];
                        $content->video_length = $contentItem['video_length'];

                        if (isset($contentItem['image']) && $contentItem['image'] ) {
                            $image = $contentItem['image'];
                            $imageName = time() . '_' . $image->getClientOriginalName();
                            $path = 'images/';
                            $image->move(public_path($path), $imageName);
                            $content->image = $path . $imageName;
                        }

                        if (isset($contentItem['video']) && $contentItem['video'] ) {
                            $video = $contentItem['video'];
                            $videoName = time() . '_' . $video->getClientOriginalName();
                            $path = 'videos/';
                            $video->move(public_path($path), $videoName);
                            $content->video = $path . $videoName;
                        }

                        $content->save();
                    }
                                        
                                        
                }
                DB::commit();
                return response()->json([
                    'status' => 200,
                    'message' => 'Course created successfully'
                ]);
            }
            catch(\Exception $e){
                return response()->json([
                    DB::rollBack(),
                    'status' => 500,
                    'error' => 'Failed to create course: ' . $e->getMessage()
                ]);

                }
}
}