<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Award;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Client;
use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Models\HeroSection;
use App\Models\NewsletterSubscriber;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Skill;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // ── Home ──────────────────────────────────────────────────
    public function home()
    {
        $hero = HeroSection::where('status', true)->orderBy('order')->first();
        $services = Service::where('status', true)->orderBy('order')->take(4)->get();
        $skills = Skill::where('status', true)->orderBy('order')->get();
        $projects = Project::where('status', true)->with('category', 'images')
            ->orderBy('order')->take(6)->get();
        $awards = Award::where('status', true)->orderBy('order')->get();
        $posts = BlogPost::published()->with('category')
            ->latest('published_at')->take(3)->get();
        $clients = Client::where('status', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('status', true)->with('project')
            ->orderBy('order')->take(4)->get();

        return view('home', compact(
            'hero',
            'services',
            'skills',
            'projects',
            'awards',
            'posts',
            'clients',
            'testimonials'
        ));
    }

    // ── About ─────────────────────────────────────────────────
    public function about()
    {
        $skills = Skill::where('status', true)->orderBy('order')->get();
        $team = TeamMember::where('status', true)->orderBy('order')->get();
        $awards = Award::where('status', true)->orderBy('order')->get();
        $clients = Client::where('status', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('status', true)->orderBy('order')->get();

        return view('about', compact('skills', 'team', 'awards', 'clients', 'testimonials'));
    }

    // ── Services ──────────────────────────────────────────────
    public function services()
    {
        $services = Service::where('status', true)->orderBy('order')->get();
        return view('services', compact('services'));
    }

    public function serviceDetail(Service $service)
    {
        $service->load('projects');
        $relatedServices = Service::where('status', true)
            ->where('id', '!=', $service->id)->orderBy('order')->take(3)->get();
        return view('service-details', compact('service', 'relatedServices'));
    }

    // ── Portfolio / Projects ──────────────────────────────────
    public function portfolio(Request $request)
    {
        $categories = ProjectCategory::where('status', true)->withCount('projects')->get();

        $query = Project::where('status', true)->with('category', 'images');

        if ($request->filled('category')) {
            $cat = ProjectCategory::where('slug', $request->category)->first();
            if ($cat)
                $query->where('category_id', $cat->id);
        }

        $projects = $query->orderBy('order')->paginate(9);
        return view('portfolio', compact('projects', 'categories'));
    }

    public function portfolioDetail(Project $project)
    {
        $project->load('category', 'images', 'service', 'tags', 'testimonials');
        $relatedProjects = Project::where('status', true)
            ->where('id', '!=', $project->id)
            ->where('category_id', $project->category_id)
            ->take(3)->get();
        return view('portfolio-details', compact('project', 'relatedProjects'));
    }

    // ── Blog ──────────────────────────────────────────────────
    public function blog(Request $request)
    {
        $query = BlogPost::published()->with('category', 'author');

        if ($request->filled('category')) {
            $cat = BlogCategory::where('slug', $request->category)->first();
            if ($cat)
                $query->where('category_id', $cat->id);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('title', 'like', "%{$s}%")
                ->orWhere('excerpt', 'like', "%{$s}%"));
        }

        $posts = $query->latest('published_at')->paginate(6);
        $categories = BlogCategory::where('status', true)->withCount('posts')->get();
        $recentPosts = BlogPost::published()->latest('published_at')->take(3)->get();
        $tags = \App\Models\Tag::has('blogPosts')->get();

        return view('blog', compact('posts', 'categories', 'recentPosts', 'tags'));
    }

    public function blogDetail(BlogPost $post)
    {
        $post->load('category', 'author', 'tags');
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->take(3)->get();
        $categories = BlogCategory::where('status', true)->withCount('posts')->get();
        $recentPosts = BlogPost::published()->latest('published_at')->take(3)->get();
        $tags = \App\Models\Tag::has('blogPosts')->get();

        return view('blog-details', compact('post', 'relatedPosts', 'categories', 'recentPosts', 'tags'));
    }

    // ── Team ──────────────────────────────────────────────────
    public function team()
    {
        $teamMembers = TeamMember::where('status', true)->orderBy('order')->get();
        return view('team', compact('teamMembers'));
    }

    public function teamDetail(TeamMember $member)
    {
        $member->load('testimonials');
        return view('team-details', compact('member'));
    }

    // ── FAQ ───────────────────────────────────────────────────
    public function faq()
    {
        $faqs = Faq::where('status', true)->orderBy('order')->get();
        return view('faq', compact('faqs'));
    }

    // ── Contact ───────────────────────────────────────────────
    public function contact()
    {
        $siteSettings = Setting::pluck('value', 'key')->toArray();
        return view('contact', compact('siteSettings'));
    }

    public function contactStore(ContactFormRequest $request)
    {
        $submission = ContactSubmission::create($request->validated());

        try {
            // Send Auto-Reply to user
            \Illuminate\Support\Facades\Mail::to($submission->email)->send(new \App\Mail\ContactAutoReply($submission));

            // Send Notification to admin
            $adminEmail = \App\Models\Setting::where('key', 'smtp_from_address')->value('value') ?? env('MAIL_FROM_ADDRESS', 'hello@example.com');
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactAdminNotification($submission));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact form email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }

    // ── Newsletter ────────────────────────────────────────────
    public function newsletterSubscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:newsletter_subscribers,email']);
        NewsletterSubscriber::create(['email' => $request->email]);

        try {
            \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\NewsletterWelcome($request->email));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Newsletter welcome email failed: ' . $e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Subscribed successfully!']);
    }

    // ── Dynamic CMS Page ──────────────────────────────────────
    public function page(string $slug)
    {
        $pageService = app(\App\Services\PageService::class);
        $page = $pageService->getPageBySlug($slug);

        if (!$page) {
            abort(404);
        }

        return view('page', compact('page'));
    }
}
