<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        $topContributors = User::select('users.*')
            ->selectRaw('(SELECT COUNT(*) FROM posts WHERE users.id = posts.user_id) as posts_count')
            ->selectRaw('(SELECT COUNT(*) FROM comments WHERE users.id = comments.user_id) as comments_count')
            ->orderByRaw('(SELECT COUNT(*) FROM posts WHERE users.id = posts.user_id) + (SELECT COUNT(*) FROM comments WHERE users.id = comments.user_id) DESC')
            ->take(4)
            ->get();

        return view('User.Community.index', compact('posts', 'topContributors'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:1000',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $post = $this->postService->createPost(
                $request->input('title'),
                $request->input('content'),
                $request->file('media') ?? []
            );

            return redirect()->route('user.community.index')
                ->with('success', 'Your post has been created successfully and is awaiting approval by an administrator. You can view all your posts <a href="' . route('user.community.my-posts') . '">here</a>.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while creating your post. Please try again.')
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
            $this->postService->updatePost($id, $request->input('content'));

            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $this->postService->addMediaToPost($id, $file);
                }
            }

            return redirect()->route('user.community.my-posts')
                ->with('success', 'Your post has been updated and is awaiting moderation.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating your post. Please try again.')
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

        return redirect()->route('user.community.my-posts')
            ->with('success', 'Your post has been deleted successfully.');
    }




    public function myPosts(Request $request)
    {
        $status = $request->query('status');

        $query = Post::with(['media', 'comments'])
            ->where('user_id', Auth::id());

        if ($status) {
            $query->where('status', $status);
        }

        $posts = $query->latest()->get();

        return view('User.Dashboard.posts', compact('posts'));
    }
}
