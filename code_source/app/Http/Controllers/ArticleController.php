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
        return view('Admin.Articles.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published,archived',
            'date' => 'required|date',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Traitement de l'image principale
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('articles/pictures', 'public');
            $validatedData['picture'] = $picturePath;
        }

        // Solution temporaire : définir user_id = 1 (admin) pour tous les articles
        $validatedData['user_id'] = 1;

        // Création de l'article
        $article = $this->articleService->createArticle($validatedData);

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Article créé avec succès.');
    }

    public function uploadTrixAttachment(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $request->validate([
                'file' => 'required|file|image|max:5000',
            ]);

            // Stocker toutes les images dans le même dossier 'articles/pictures'
            $path = $file->store('articles/pictures', 'public');

            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Aucun fichier n\'a été téléchargé.'], 422);
    }

    public function show($id)
    {
        $article = $this->articleService->getArticleById($id);
        return view('Admin.Articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = $this->articleService->getArticleById($id);
        return view('Admin.Articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = $this->articleService->getArticleById($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:published,draft,archived',
            'date' => 'required|date',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // L'image est optionnelle lors de l'édition
        ]);

        // Traitement de l'image principale si une nouvelle est téléchargée
        if ($request->hasFile('picture')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->picture && file_exists(storage_path('app/public/' . $article->picture))) {
                unlink(storage_path('app/public/' . $article->picture));
            }

            // Stocker la nouvelle image
            $picturePath = $request->file('picture')->store('articles/pictures', 'public');
            $validated['picture'] = $picturePath;
        } else {
            // Ne pas modifier l'image si aucune nouvelle n'est fournie
            unset($validated['picture']);
        }

        // Mise à jour de l'article
        $this->articleService->updateArticle($id, $validated);

        return redirect()->route('articles.show', $id)
            ->with('success', 'Article mis à jour avec succès');
    }

    public function destroy($id)
    {
        $this->articleService->deleteArticle($id);
        return redirect()->route('Admin.Articles.index')->with('success', 'Publication supprimée avec succès');
    }

}
