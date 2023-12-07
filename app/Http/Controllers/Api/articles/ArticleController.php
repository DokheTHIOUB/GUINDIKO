<?php

namespace App\Http\Controllers\Api\articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste des articles',
                'data' => Article::all(),
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function store(CreateArticleRequest $request)
    {
        try {
            $article = new Article();
            $article->libelle = $request->libelle;
            $article->description = $request->description;
            $article->debouche = $request->debouche;
            $article->image = $this->storeImage($request->image);
            $article->save();
            // dd($article);
            return response()->json([
                'status_code' => 200, //Pour montrer que la réquete a été effectuer
                'status_message' => 'L\'article a été ajouter',
                'article' => $article
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function storeImage($image)
    {
        return $image->store('images', 'public');
    }

    public function update(EditArticleRequest $request, Article $article)
    {
        try {
            $article->libelle = $request->libelle;
            $article->description = $request->description;
            $article->debouche = $request->debouche;

            if ($request->hasFile("image")) {
                $article->image = $this->storeImage($request->image);
            }
            $article->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'L\'article a été modifier',
                'article' => $article
            ]);

        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function destroy(Article $article)
    {
        try {
            $article->delete();

            return response()->json([
                'status_code' => 200, 
                'status_message' => 'Le post a été supprimer',
                'article' => $article
            ]);

        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
