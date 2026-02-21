<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'blog_posts' => BlogPost::count(),
            'team_members' => TeamMember::count(),
            'inquiries' => ContactSubmission::count(),
            'unread_inquiries' => ContactSubmission::unread()->count(),
            'subscribers' => NewsletterSubscriber::active()->count(),
        ];

        $recentInquiries = ContactSubmission::latest()->take(5)->get();
        $recentPosts = BlogPost::with('category')->latest()->take(5)->get();

        return view('admin.content.dashboard', compact('stats', 'recentInquiries', 'recentPosts'));
    }
}
