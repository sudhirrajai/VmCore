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
        // ── Existing text fields ──────────────────────────────────
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

            // About section titles
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
            'contact_form_subtitle' => 'contact_form_subtitle',
            'faq_title' => 'faq_title',

            // ── Page Header Text Keys ───────────────────────────────
            // About
            'about_breadcrumb_title' => 'about_breadcrumb_title',
            'about_intro_title' => 'about_intro_title',
            'about_intro_description' => 'about_intro_description',
            'about_meta_description' => 'about_meta_description',

            // Services
            'services_breadcrumb_title' => 'services_breadcrumb_title',
            'services_page_intro' => 'services_page_intro',
            'services_meta_description' => 'services_meta_description',

            // Team
            'team_breadcrumb_title' => 'team_breadcrumb_title',
            'team_page_intro' => 'team_page_intro',
            'team_meta_description' => 'team_meta_description',

            // FAQ
            'faq_breadcrumb_title' => 'faq_breadcrumb_title',
            'faq_meta_description' => 'faq_meta_description',

            // Portfolio
            'portfolio_breadcrumb_title' => 'portfolio_breadcrumb_title',
            'portfolio_meta_description' => 'portfolio_meta_description',

            // Blog
            'blog_breadcrumb_title' => 'blog_breadcrumb_title',
            'blog_meta_description' => 'blog_meta_description',

            // Contact
            'contact_breadcrumb_title' => 'contact_breadcrumb_title',
            'contact_meta_description' => 'contact_meta_description',
        ];

        foreach ($keys as $field => $key) {
            if ($request->has($field)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->$field ?? '']
                );
            }
        }

        // ── Page Visibility Toggles ──────────────────────────────
        $pageToggles = [
            'show_about_page',
            'show_services_page',
            'show_team_page',
            'show_faq_page',
            'show_portfolio_page',
            'show_blog_page',
            'show_contact_page',
        ];
        foreach ($pageToggles as $toggle) {
            Setting::set($toggle, $request->has($toggle) ? 1 : 0);
        }

        // ── Hero Image Uploads ───────────────────────────────────
        $heroImageFields = [
            'about_hero_image',
            'services_hero_image',
            'team_hero_image',
            'faq_hero_image',
            'portfolio_hero_image',
            'blog_hero_image',
            'contact_hero_image',
            // Section images
            'home_skills_bg',
            'home_video_bg',
            'about_side_image',
            'service_detail_hero_image',
            'portfolio_detail_hero_image',
        ];

        foreach ($heroImageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file
                $old = Setting::where('key', $field)->value('value');
                if ($old && file_exists(public_path($old))) {
                    @unlink(public_path($old));
                }

                $file = $request->file($field);
                $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);

                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => 'uploads/settings/' . $filename]
                );
            }
        }

        $this->settingService->clearCache();

        return back()->with('success', 'Frontend content settings updated successfully.');
    }
}
