<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->middleware('admin');
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        if ($search) {
            $articles = $this->articleService->searchArticles($search, $status);
        } elseif ($status) {
            $articles = $this->articleService->getArticlesByStatus($status);
        } else {
            $articles = $this->articleService->getAllArticles();
        }

        $stats = $this->articleService->getArticleStats();

        return view('Admin.Articles.index', compact('articles', 'stats'));
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

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('articles/pictures', 'public');
            $validatedData['picture'] = $picturePath;
        }


        $article = $this->articleService->createArticle($validatedData);

        return redirect()->route('admin.articles.show', $article->id)
            ->with('success', 'Article created successfully.');
    }

    public function uploadTrixAttachment(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $request->validate([
                'file' => 'required|file|image|max:5000',
            ]);

            // Store the file in the public storage
            $path = $file->store('articles/pictures', 'public');

            // Return the URL to the stored file
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'No file was uploaded.'], 422);
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
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional when editing
        ]);

        if ($request->hasFile('picture')) {
            if ($article->picture && file_exists(storage_path('app/public/' . $article->picture))) {
                unlink(storage_path('app/public/' . $article->picture));
            }

            $picturePath = $request->file('picture')->store('articles/pictures', 'public');
            $validated['picture'] = $picturePath;
        } else {
            unset($validated['picture']);
        }

        $this->articleService->updateArticle($id, $validated);

        return redirect()->route('admin.articles.show', $id)
            ->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $this->articleService->deleteArticle($id);
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }

    public function archive($id)
    {
        $article = $this->articleService->getArticleById($id);

        $this->articleService->archiveArticle($id);

        return redirect()->route('admin.articles.show', $id)
            ->with('success', 'Article has been archived.');
    }

    public function publish($id)
    {
        $article = $this->articleService->getArticleById($id);

        $this->articleService->publishArticle($id);

        return redirect()->route('admin.articles.show', $id)
            ->with('success', 'Article has been published.');
    }
}
