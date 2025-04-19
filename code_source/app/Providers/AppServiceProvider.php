<?php

namespace App\Providers;

use App\Repositories\Eloquent\ArticleRepository;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\DonationRepository;
use App\Repositories\Eloquent\ObservationRepository;
use App\Repositories\Eloquent\PostMediaRepository;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\SerologyRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use App\Repositories\Interfaces\ObservationRepositoryInterface;
use App\Repositories\Interfaces\PostMediaRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\SerologyRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\ObservationService;
use App\Services\SerologyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(DonationRepositoryInterface::class, DonationRepository::class);
        $this->app->bind(SerologyRepositoryInterface::class, SerologyRepository::class);
        $this->app->bind(ObservationRepositoryInterface::class, ObservationRepository::class);
        $this->app->bind(ObservationService::class, function ($app) {
            return new ObservationService($app->make(ObservationRepositoryInterface::class));
        });
        $this->app->bind(SerologyService::class, function ($app) {
            return new SerologyService($app->make(SerologyRepositoryInterface::class));
        });
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostMediaRepositoryInterface::class, PostMediaRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
