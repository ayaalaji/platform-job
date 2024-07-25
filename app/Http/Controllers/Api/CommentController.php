<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Traits\CommentResponseTrait;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{ 
    use CommentResponseTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
           $comments=CommentResource::collection(Comment::all());
           return $this->commentResponse($comments,'index successfully',200);
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return $this->apiResponse('something went wrong when you want to see all comments',400);
        }    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
         try{
            $request->validated();
            $user_id = auth()->user()->id;
    
              $comment = Comment::create([
                'comment' => $request->comment,
                'user_id' => $user_id,
            ]);
           
            $comment->save();
            return $this->commentResponse(new CommentResource($comment),'you add comment successfully',201);
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return $this->apiResponse('something went wrong when you add comment,sorry',400);
        }  }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try{
             $user = Auth::user();
             $comment = Comment::where('user_id', $user->id)->get();
             $commentResourse=CommentResource::collection($comment);
             return  $this->commentResponse($commentResourse,'this is your request',200);
        }catch(\Exception $th){
            Log::error($th->getMessage());
            return $this->apiResponse('something went wrong when you show comment,sorry',400);
        }   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        try{
           $request->validated();
        
           if ($comment->user_id !== auth()->user()->id) {
              return $this->apiResponse( 'You can not edit ,because this comment is not yours',400);
           }
           else{
               $comment->comment=$request->comment;
               $comment->save();
               return $this->commentResponse(new CommentResource($comment),'you updated comment successfully',201);
           }
        }catch (\Exception $th) {
            Log::error($th->getMessage());
            return $this->apiResponse('something went wrong when you update comment,sorry',400);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try{
           if ($comment->user_id !== auth()->user()->id) {
             return $this->apiResponse('You can not delete ,because this comment is not yours',400);
           }
           else{
              $comment->delete();
              return $this->apiDelete('you deleted successfully',200);
           }
        } catch (\Exception $th) {
            Log::error($th->getMessage());
            return $this->apiResponse('something went wrong when you comment review,sorry',400);
        }
    }
    }
