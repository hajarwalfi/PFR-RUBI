<?php


namespace App\Http\Controllers;

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
        $status = $request->query('status', null);
        $search = $request->query('search', null);

        if ($status) {
            $articles = $this->articleService->getArticlesByStatus($status);
        } elseif ($search) {
            $articles = $this->articleService->searchArticles($search);
        } else {
            $articles = $this->articleService->getAllArticles();
        }

        $stats = $this->articleService->getArticleStats();

        return view('admin.articles.index', compact('articles', 'stats'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:published,draft,archived',
            'date' => 'required|date',
        ]);

        $this->articleService->createArticle($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Publication créée avec succès');
    }

    public function show($id)
    {
        $article = $this->articleService->getArticleById($id);
        return view('admin.articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = $this->articleService->getArticleById($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:published,draft,archived',
            'date' => 'required|date',
        ]);

        $this->articleService->updateArticle($id, $validated);

        return redirect()->route('admin.articles.index')->with('success', 'Publication mise à jour avec succès');
    }

    public function destroy($id)
    {
        $this->articleService->deleteArticle($id);
        return redirect()->route('admin.articles.index')->with('success', 'Publication supprimée avec succès');
    }
}
