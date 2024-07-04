<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Trait\ApiResponseTrait;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
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
        $query=Article::query();
        if($request->company_id ){
            $query->where('company_id',$request->company_id);
        }
        $articles=$query->get();
        return $this->apiResponse(Article::collection($articles),'all Post',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
       $request->validated();
        $article=new Article();
        $article->title=$request->title;
        $article->body=$request->body;
        $article->company_id=$request->company_id;
       
        $article->save();
        return $this->apiResponse ($article,'you added Article successfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return  $this->apiResponse(new ArticleResource($article),'this is your request',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $request->validated();
        $article->title=$request->title??$article->title;
        $article->body=$request->body??$article->body;
        $article->company_id=$request->company_id??$article->company_id;

        $article->save();
        return $this->apiResponse(new ArticleResource($article),'you update article',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return $this->apiDelete('you deleted successfully',200);
    }
}
