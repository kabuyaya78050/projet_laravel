<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    /* Route : GET /dashboard — nom : dashboard.index */
    public function index()
    {
        $totalarticles = Post::all()->count();
        $totalcategories = Category::all()->count();
        $totalcomments = Comment::all()->count();
        $totalusers = User::all()->count();
        return view('dashboard.index', compact('totalarticles', 'totalcategories', 'totalcomments', 'totalusers'));
    }

    /* Route : GET /dashboard/articles — nom : dashboard.articles */
    public function articles()
    {
        $articles = Post::with(['category', 'user'])->latest()->limit(10)->get();
        return view('dashboard.articles', compact('articles'));
    }

    /* Route : GET /dashboard/categories — nom : dashboard.categories */
    public function categories()
    {
        $categories = Category::latest()->limit(10)->get();
        return view('dashboard.categories', compact('categories'));
    }

    /* Route : GET /dashboard/utilisateurs — nom : dashboard.users */
    public function users()
    {
        $users = User::latest()->limit(10)->get();
        return view('dashboard.users', compact('users'));
    }

    /* Route : GET /dashboard/commentaires — nom : dashboard.comments */
    public function comments()
    {
        $comments = Comment::latest()->limit(10)->get();
        return view('dashboard.comments', compact('comments'));
    }

    /* Route : GET /dashboard/reglages — nom : dashboard.settings */
    public function settings()
    {
        return view('dashboard.settings');
    }
}
