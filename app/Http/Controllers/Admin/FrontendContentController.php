<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;

class FrontendContentController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.frontend', compact('settings'));
    }

    public function update(Request $request)
    {
        // Define all keys that are managed by this page
        $keys = [
            // Home View
            'home_hero_title' => 'home_hero_title',
            'home_services_title' => 'home_services_title',
            'home_skills_title' => 'home_skills_title',
            'home_skills_subtitle' => 'home_skills_subtitle',
            'home_portfolio_title' => 'home_portfolio_title',
            'home_blog_title' => 'home_blog_title',
            'home_cta_title' => 'home_cta_title',
            'home_cta_subtitle' => 'home_cta_subtitle',

            // About View
            'about_skills_title' => 'about_skills_title',
            'about_team_title' => 'about_team_title',
            'about_awards_title' => 'about_awards_title',
            'about_testimonials_title' => 'about_testimonials_title',
            'about_clients_title' => 'about_clients_title',

            // Sidebar & Other Widgets
            'sidebar_services_title' => 'sidebar_services_title',
            'sidebar_help_title' => 'sidebar_help_title',
            'sidebar_categories_title' => 'sidebar_categories_title',
            'sidebar_recent_posts_title' => 'sidebar_recent_posts_title',
            'sidebar_tags_title' => 'sidebar_tags_title',

            // Portfolio Details
            'portfolio_gallery_title' => 'portfolio_gallery_title',
            'portfolio_info_title' => 'portfolio_info_title',
            'portfolio_tags_title' => 'portfolio_tags_title',
            'portfolio_testimonials_title' => 'portfolio_testimonials_title',
            'portfolio_related_title' => 'portfolio_related_title',

            // Service Details
            'service_related_projects_title' => 'service_related_projects_title',

            // Contact & FAQ
            'contact_form_title' => 'contact_form_title',
            'faq_title' => 'faq_title'
        ];

        foreach ($keys as $field => $key) {
            if ($request->has($field)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->$field ?? '']
                );
            }
        }

        $this->settingService->clearCache();

        return back()->with('success', 'Frontend content texts updated successfully.');
    }
}
