<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Trait\ApiResponseTrait;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    use ApiResponseTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'company_id'=>'integer',  
        ]);
        $query=Article::query();
        if($request->company_id ){
            $query->where('company_id',$request->company_id);
        }
        $articles=$query->get();
        return $this->apiResponse(ArticleResource::collection($articles),'all Article',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
       $user = Auth::user();
        $request->validated();

        // التحقق من أن المستخدم مدير للشركة المعينة قبل إضافة المقالة
        if (!in_array('Manager', $user->role) || $user->company_id != $request->company_id) {
            return $this->apiResponse(null, 'Unauthorized to add article for this company', 403);
        }

        $article = new Article();
        $article->title = $request->title;
        $article->body = $request->body;
        $article->company_id = $request->company_id;

        $article->save(); 
        return $this->apiResponse(new ArticleResource($article), 'You added Article successfully', 200);
   
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
         $user = Auth::user();

        // التحقق من أن المستخدم مدير للشركة التي تنتمي إليها المقالة
        if (!$user->company_id) {
            return $this->apiResponse(null, 'Unauthorized: No company associated with user', 403);
        }

        // عرض المقالات الخاصة بشركة المستخدم فقط
        $articles = Article::where('company_id', $user->company_id)->get();

        return $this->apiResponse(ArticleResource::collection($articles), 'Articles for user\'s company', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
       $user = Auth::user();
        $request->validated();

        // التحقق من أن المستخدم مدير للشركة التي تنتمي إليها المقالة قبل تحديث المقالة
        if (!in_array('Manager', $user->role) || $user->company_id != $article->company_id) {
            return $this->apiResponse(null, 'Unauthorized to update this article', 403);
        }

        $article->title = $request->title ?? $article->title;
        $article->body = $request->body ?? $article->body;
        $article->company_id = $request->company_id ?? $article->company_id;

        $article->save();
        return $this->apiResponse(new ArticleResource($article), 'You updated article successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $user = Auth::user();

        // التحقق من أن المستخدم مدير للشركة التي تنتمي إليها المقالة قبل حذف المقالة
        if (!in_array('Manager', $user->role) || $user->company_id != $article->company_id) {
            return $this->apiResponse(null, 'Unauthorized to delete this article', 403);
        }
        
            $article->forceDelete();
            return $this->apiDelete('You deleted article successfully', 200);
           
    }
}
