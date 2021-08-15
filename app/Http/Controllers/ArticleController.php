<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
class ArticleController extends Controller
{
    public function index(){
        $articles = Article::all();
        return $articles->toJson();
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $project = Article::create([
            'title' => $validateData['title'],
            'content' => $validateData['content'],
        ]);
        $msg = [
            'success'=> true,
            'message' => 'Article created successfully!'
        ];
        return response()->json($msg);

    }
    public function getArticle($id){
        $article = Article::find($id);
        return $article->toJson();
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $article = Article::find($id);
        $article->title = $validatedData['title'];
        $article->content = $validatedData['content'];
        $article->save();

        $msg = [
            'success' => true,
            'message' => 'Article updated successfully'
        ];

        return response()->json($msg);
    }
    public function delete($id)
    {
        $article = \App\Article::find($id);
        if(!empty($article)){
            $article->delete();
            $msg = [
                'success' => true,
                'message' => 'Article deleted successfully!'
            ];
            return response()->json($msg);
        } else {
            $msg = [
                'success' => false,
                'message' => 'Article deleted failed!'
            ];
            return response()->json($msg);
        }
    }

}
