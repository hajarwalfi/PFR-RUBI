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
    public function searchArticles($query, $status = null)
    {
        // Start with a base query
        $articles = Article::with('user');

        if (!empty($query)) {
            $query = trim($query);

            // First, try to find exact matches for the full search query
            $exactMatches = clone $articles;
            $exactMatches = $exactMatches->where('title', 'ilike', $query);

            // If we have exact matches, return those
            if ($exactMatches->count() > 0) {
                if ($status) {
                    $exactMatches->where('status', $status);
                }
                return $exactMatches->orderBy('created_at', 'desc')->paginate(12);
            }

            // Otherwise, split into keywords and search
            $keywords = array_filter(explode(' ', $query));

            if (!empty($keywords)) {
                $articles->where(function($q) use ($keywords, $query) {
                    // First add a condition for the full query string
                    $q->where('title', 'ilike', "%{$query}%")
                        ->orWhere('content', 'ilike', "%{$query}%");

                    // Then add conditions for each keyword
                    foreach ($keywords as $keyword) {
                        if (strlen($keyword) >= 3) { // Only search for keywords with at least 3 characters
                            $q->orWhere('title', 'ilike', "%{$keyword}%")
                                ->orWhere('content', 'ilike', "%{$keyword}%");
                        }
                    }
                });
            }
        }

        // Apply status filter if provided
        if ($status) {
            $articles->where('status', $status);
        }

        return $articles->orderBy('created_at', 'desc')->paginate(12);
    }
}
