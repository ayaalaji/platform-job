<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
     public function __construct()
    {

        $this->middleware(['permission:إدارة البوستات|البوستات'])->only('index');
        $this->middleware(['permission:حذف بوست'])->only(['destroy', 'forceDelete']);
        $this->middleware(['permission:استعادة بوست'])->only('restore');
    }
    public function index()
    {
        try {
            $posts = Post::all();
            $trachedPosts = Post::onlyTrashed()->get();
            return view('Admin.post', compact('posts', 'trachedPosts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred  ' . $e->getMessage());
        }

    }

//========================================================================================================================
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            session()->flash('delete', 'delete succsesfuly');
            return redirect()->route('post.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Post: ' . $e->getMessage());
        }
    }

//========================================================================================================================
    public function restore($id)
    {
        try {
            $post = Post::withTrashed()->findOrFail($id);
            $post->restore();
            return redirect()->route('post.index')->with('edit', 'Post restored successfully.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed to delete Post: ' . $th->getMessage());
        }
    }

//========================================================================================================================

    public function forceDelete($id)
    {
        try {
            $post = Post::withTrashed()->findOrFail($id);
            $post->forceDelete();

            return redirect()->route('post.index')->with('delete', 'Post permanently deleted.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed to delete Post: ' . $th->getMessage());
        }
    }
    
//========================================================================================================================

}
