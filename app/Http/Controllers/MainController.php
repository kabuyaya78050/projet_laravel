<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
class MainController extends Controller
{
    /** Route : GET / — nom : home — Vue : public/index.blade.php */
    public function index()
    {
        $articles = Post::orderByDesc('id')->limit(3)->get();
        $categories = Category::orderByDesc('id')->limit(3)->get();
        $totalarticles = Post::all()->count();
        $totalcategories = Category::all()->count();
        $totalcomments = Comment::all()->count();
        $totalusers = User::all()->count();
        return view('public.index', compact('articles', 'categories', 'totalarticles', 'totalcategories', 'totalcomments', 'totalusers'));
    }

    /** Route : GET /articles — nom : articles.index */
    public function articles()
    {
        $articles = Post::orderByDesc('id')->get();
        $totalarticles = Post::all()->count();
        $totalcategories = Category::all()->count();
        $totalcomments = Comment::all()->count();


        return view('public.articles', compact('articles', 'totalarticles', 'totalcategories', 'totalcomments'));
    }

    /**
     * Route : GET /articles/{slug} — nom : articles.show
     
     */
    public function article(string $slug)
    {
       
        return view('public.article', compact('slug'));
    }

    /** Route : GET /categories — nom : categories.index */
    public function categories()
    {
        return view('public.categories');
    }

    /** Route : GET /about — nom : about */
    public function about()
    {
        return view('public.about');
    }
}
