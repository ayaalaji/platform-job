<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
     public function __construct()
    {

        $this->middleware(['permission:إدارة المقالات|المقالات'])->only('index');
        $this->middleware(['permission:حذف مقالة'])->only(['destroy', 'forceDelete']);
        $this->middleware(['permission:استعادة مقالة'])->only('restore');
    }
    public function index()
    {
        try {
            $articles = Article::all();
            $trachedArticles = Article::onlyTrashed()->get();
            return view('Admin.article', compact('articles', 'trachedArticles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred  ' . $e->getMessage());
        }

    }

//========================================================================================================================
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            session()->flash('delete', 'delete succsesfuly');
            return redirect()->route('article.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete Article: ' . $e->getMessage());
        }
    }

//========================================================================================================================
    public function restore($id)
    {
        try {
            $article = Article::withTrashed()->findOrFail($id);
            $article->restore();
            return redirect()->route('article.index')->with('edit', 'Article restored successfully.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed to delete Article: ' . $th->getMessage());
        }
    }

//========================================================================================================================

    public function forceDelete($id)
    {
        try {
            $article = Article::withTrashed()->findOrFail($id);
            $article->forceDelete();

            return redirect()->route('article.index')->with('delete', 'Article permanently deleted.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed to delete Article: ' . $th->getMessage());
        }
    }
    
//========================================================================================================================

}
