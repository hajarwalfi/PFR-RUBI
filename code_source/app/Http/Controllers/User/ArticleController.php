<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $articles = $this->articleService->searchArticles($search, 'published');
        } else {
            $articles = $this->articleService->getPublishedArticles();
        }

        return view('User.Articles.index', compact('articles'));
    }

    public function show($id)
    {
        try {
            $article = $this->articleService->getPublishedArticleById($id);

            $this->articleService->incrementViewCount($id);

            return view('User.Articles.show', compact('article'));
        } catch (\Exception $e) {
            abort(404, 'Article not found');
        }
    }

    public function home(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $articles = $this->articleService->getHomePageArticles(4);

        return view('home', compact('articles'));
    }
}
