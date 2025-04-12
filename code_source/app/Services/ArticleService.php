<?php

namespace App\Services;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAllArticles()
    {
        return $this->articleRepository->getAllArticles();
    }

    public function getArticleById($id)
    {
        return $this->articleRepository->getArticleById($id);
    }

    public function getArticlesByStatus($status)
    {
        return $this->articleRepository->getArticlesByStatus($status);
    }

    public function createArticle(array $articleData)
    {
        // Ajouter l'utilisateur actuel comme auteur si non spécifié
        if (!isset($articleData['user_id'])) {
            $articleData['user_id'] = Auth::id();
        }

        return $this->articleRepository->createArticle($articleData);
    }

    public function updateArticle($id, array $newDetails)
    {
        return $this->articleRepository->updateArticle($id, $newDetails);
    }

    public function deleteArticle($id)
    {
        return $this->articleRepository->deleteArticle($id);
    }

    public function getArticleStats()
    {
        return $this->articleRepository->getArticleStats();
    }

    public function searchArticles($query, $status = null)
    {
        return $this->articleRepository->searchArticles($query, $status);
    }

}
