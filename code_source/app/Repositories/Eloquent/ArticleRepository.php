<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAllArticles()
    {
        return Article::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function getArticleById($id)
    {
        return Article::with('user')->findOrFail($id);
    }

    public function getArticlesByStatus($status)
    {
        return Article::with('user')->where('status', $status)->orderBy('created_at', 'desc')->get();
    }

    public function createArticle(array $articleData)
    {
        return Article::create($articleData);
    }

    public function updateArticle($id, array $newDetails)
    {
        return Article::whereId($id)->update($newDetails);
    }

    public function deleteArticle($id)
    {
        return Article::destroy($id);
    }

    public function getArticleStats()
    {
        $total = Article::count();
        $published = Article::where('status', 'published')->count();
        $draft = Article::where('status', 'draft')->count();
        $archived = Article::where('status', 'archived')->count();

        return [
            'total' => $total,
            'published' => $published,
            'draft' => $draft,
            'archived' => $archived,
            'published_percentage' => $total > 0 ? round(($published / $total) * 100, 1) : 0,
            'draft_percentage' => $total > 0 ? round(($draft / $total) * 100, 1) : 0,
            'archived_percentage' => $total > 0 ? round(($archived / $total) * 100, 1) : 0
        ];
    }
}
