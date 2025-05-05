<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = $this->postService->getApprovedPosts();

        return view('User.Community.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        if ($post->status !== 'approved' && $post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($post->user_id !== Auth::id()) {
            $this->postService->incrementViews($id);
        }

        return view('User.Community.show', compact('post'));
    }

    public function create()
    {
        return view('User.Community.create');
    }

    public function store(Request $request)
    {
        Log::info('Post creation started', [
            'user_id' => Auth::id(),
            'has_title' => !empty($request->input('title')),
            'content_length' => strlen($request->input('content')),
            'has_media' => $request->hasFile('media'),
            'media_count' => $request->hasFile('media') ? count($request->file('media')) : 0,
            'all_request_data' => $request->all() // Pour déboguer
        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
        ]);

        if ($validator->fails()) {
            Log::warning('Post validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Vérifiez si les fichiers sont correctement reçus
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $index => $file) {
                    Log::info('Media file details', [
                        'index' => $index,
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                        'is_valid' => $file->isValid(),
                        'error' => $file->getError()
                    ]);
                }
            }

            $post = $this->postService->createPost(
                $request->input('title'),
                $request->input('content'),
                $request->file('media') ?? []
            );

            Log::info('Post created successfully', ['post_id' => $post->id]);

            return redirect()->route('user.community.index')
                ->with('success', 'Your post has been created successfully and is awaiting approval by an administrator.');
        } catch (\Exception $e) {
            Log::error('Post creation failed', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while creating your post: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('User.Community.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = $this->postService->getPostById($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $this->postService->updatePost(
                $id,
                $request->input('title'),
                $request->input('content')
            );

            return redirect()->route('dashboard.myPosts')
                ->with('success', 'Your post has been updated and is awaiting moderation.');
        } catch (\Exception $e) {
            Log::error('Post update failed', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating your post: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $post = $this->postService->getPostById($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->postService->deletePost($id);

        return redirect()->route('user.community.index')
            ->with('success', 'Your post has been deleted successfully.');
    }

    public function myPosts(Request $request)
    {
        $status = $request->query('status');
        $userId = Auth::id();

        $posts = $this->postService->getPaginatedUserPosts($userId, $status);

        return view('User.Dashboard.posts', compact('posts'));
    }
}
