<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Comment; 
use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects     = Project::published()->ordered()->get();
        $certificates = Certificate::published()->ordered()->get();
        $comments     = Comment::approved()->latest()->get();

        return view('index', compact('projects', 'certificates', 'comments'));
    }
}