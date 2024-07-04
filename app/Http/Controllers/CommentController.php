<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
        public function __construct()
    {

        $this->middleware(['permission:ادارة التعليقات|التعليقات'])->only('index');
        $this->middleware(['permission:حذف تعليق'])->only('destroy');
    }

//========================================================================================================================

    public function index()
    {
        try {
            $comments = Comment::all();
            return view('Admin.comment', compact('comments'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred  ' . $e->getMessage());
        }

    }

//========================================================================================================================
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            session()->flash('delete', 'delete succsesfuly');
            return redirect()->route('comments.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete comment: ' . $e->getMessage());
        }
    }

//========================================================================================================================
    

}