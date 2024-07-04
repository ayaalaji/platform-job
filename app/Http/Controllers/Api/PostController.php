<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResourse;
use App\Http\Trait\ApiResponseTrait;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    function __construct()
    {
        $this->middleware('company')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'company_id'=>'integer',  
        ]);
        $query=Post::query();
        if($request->company_id ){
            $query->where('company_id',$request->company_id);
        }
      $posts=$query->get();
        return $this->apiResponse(PostResourse::collection($posts),'all Post',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $request->validated();
        $post=new Post();
        $post->title=$request->title;
        $post->job_role=$request->job_role;
        $post->career_level=$request->career_level;
        $post->experience_needed=$request->experience_needed;
        $post->job_title=$request->job_title;
        $post->keywords=$request->keywords;
        $post->name=$request->name;
        $post->address=$request->address;
        $post->company_id=$request->company_id;
       
        $post->save();
        return $this->apiResponse ($post,'you added Post successfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return  $this->apiResponse(new PostResourse($post),'this is your request',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $request->validated();
        $post->title=$request->title??$post->title;
        $post->job_role=$request->job_role??$post->job_role;
        $post->career_level=$request->career_level??$post->career_level;
        $post->experience_needed=$request->experience_needed??$post->experience_needed;
        $post->job_title=$request->job_title??$post->job_title;
        $post->keywords=$request->keywords??$post->keywords;
        $post->name=$request->name??$post->name;
        $post->address=$request->address??$post->address;
        $post->company_id=$request->company_id??$post->company_id;
        $post->save();
        return $this->apiResponse(new PostResourse($post),'you update post$post',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->apiDelete('you deleted successfully',200);
    }
}
