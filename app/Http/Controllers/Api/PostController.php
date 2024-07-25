<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResourse;
use App\Http\Trait\ApiResponseTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ApiResponseTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'company_id' => 'integer',
        ]);
        $query = Post::query();
        if ($request->company_id) {
            $query->where('company_id', $request->company_id);
        }
        $posts = $query->get();
        return $this->apiResponse(PostResourse::collection($posts), 'all Post', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $user = Auth::user();
        $request->validated();

        if (!in_array('Manager', $user->role) || $user->company_id != $request->company_id) {
            return $this->apiResponse(null, 'Unauthorized to add posts for this company', 403);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->job_role = $request->job_role;
        $post->career_level = $request->career_level;
        $post->experience_needed = $request->experience_needed;
        $post->job_type = $request->job_type;
        $post->key_skills = $request->key_skills;
        $post->address = $request->address;
        $post->company_id = $request->company_id;

        $post->save();
        return $this->apiResponse($post, 'you added Post successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();

        // التحقق من أن المستخدم لديه company_id صالح
        if (!$user->company_id) {
            return $this->apiResponse(null, 'Unauthorized: No company associated with user', 403);
        }

        // عرض البوستات الخاصة بشركة المستخدم فقط
        $posts = Post::where('company_id', $user->company_id)->get();

        return $this->apiResponse(PostResourse::collection($posts), 'Posts for user\'s company', 200);
   
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $user = Auth::user();
        $request->validated();

        if (!in_array('Manager', $user->role) || $user->company_id != $post->company_id) {
            return $this->apiResponse(null, 'Unauthorized to update this post', 403);
        }

        $post->title = $request->title ?? $post->title;
        $post->job_role = $request->job_role ?? $post->job_role;
        $post->career_level = $request->career_level ?? $post->career_level;
        $post->experience_needed = $request->experience_needed ?? $post->experience_needed;
        $post->job_type = $request->job_type ?? $post->job_type;
        $post->key_skills = $request->key_skills ?? $post->key_skills;
        $post->address = $request->address ?? $post->address;
        $post->company_id = $request->company_id ?? $post->company_id;

        $post->save();
        return $this->apiResponse(new PostResourse($post), 'you updated post successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $user = Auth::user();

        if (!in_array('Manager', $user->role) || $user->company_id != $post->company_id) {
            return $this->apiResponse(null, 'Unauthorized to delete this post', 403);
        }

        $post->forceDelete();
        return $this->apiDelete('you deleted successfully', 200);
    }
}