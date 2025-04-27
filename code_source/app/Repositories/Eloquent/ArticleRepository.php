<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAllArticles()
    {
        return Article::orderBy('created_at', 'desc')->get();
    }

    public function getArticleById($id)
    {
        return Article::findOrFail($id);
    }

    public function getArticlesByStatus($status)
    {
        return Article::where('status', $status)->orderBy('created_at', 'desc')->get();
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

    public function searchArticles($query, $status = null)
    {
        $articles = Article::query();

        if (!empty($query)) {
            $query = trim($query);

            $exactMatches = clone $articles;
            $exactMatches = $exactMatches->where('title', 'ilike', $query);

            if ($exactMatches->count() > 0) {
                if ($status) {
                    $exactMatches->where('status', $status);
                }
                return $exactMatches->orderBy('created_at', 'desc')->paginate(12);
            }

            $keywords = array_filter(explode(' ', $query));

            if (!empty($keywords)) {
                $articles->where(function($q) use ($keywords, $query) {
                    $q->where('title', 'ilike', "%{$query}%")
                        ->orWhere('content', 'ilike', "%{$query}%");

                    foreach ($keywords as $keyword) {
                        if (strlen($keyword) >= 3) {
                            $q->orWhere('title', 'ilike', "%{$keyword}%")
                                ->orWhere('content', 'ilike', "%{$keyword}%");
                        }
                    }
                });
            }
        }

        if ($status) {
            $articles->where('status', $status);
        }

        return $articles->orderBy('created_at', 'desc')->paginate(12);
    }

    public function archiveArticle($id)
    {
        return Article::whereId($id)->update(['status' => 'archived']);
    }

    public function publishArticle($id)
    {
        return Article::whereId($id)->update(['status' => 'published']);
    }

    public function getPublishedArticles()
    {
        return Article::where('status', 'published')
            ->orderBy('date', 'desc')
            ->paginate(10);
    }

    public function getPublishedArticleById($id)
    {
        return Article::where('id', $id)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function incrementViewCount($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->views = ($article->views ?? 0) + 1;
            $article->save();
            return true;
        }
        return false;
    }
}
