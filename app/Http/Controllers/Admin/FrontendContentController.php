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
            'home_hero_fallback_title' => 'home_hero_fallback_title',
            'home_hero_fallback_description' => 'home_hero_fallback_description',
            'home_hero_button_text' => 'home_hero_button_text',
            'home_service_link_text' => 'home_service_link_text',
            'home_project_overlay_text' => 'home_project_overlay_text',

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
            'portfolio_story_title' => 'portfolio_story_title',
            'portfolio_facts_title' => 'portfolio_facts_title',
            'portfolio_fact_client_label' => 'portfolio_fact_client_label',
            'portfolio_fact_industry_label' => 'portfolio_fact_industry_label',
            'portfolio_fact_tech_label' => 'portfolio_fact_tech_label',
            'portfolio_fact_services_label' => 'portfolio_fact_services_label',
            'portfolio_fact_date_label' => 'portfolio_fact_date_label',
            'portfolio_visit_button_text' => 'portfolio_visit_button_text',
            'portfolio_view_button_text' => 'portfolio_view_button_text',
            'portfolio_problem_title' => 'portfolio_problem_title',
            'portfolio_features_title' => 'portfolio_features_title',
            'portfolio_gallery_section_title' => 'portfolio_gallery_section_title',
            'portfolio_feedback_title' => 'portfolio_feedback_title',
            'portfolio_related_label' => 'portfolio_related_label',
            'portfolio_related_heading' => 'portfolio_related_heading',
            'portfolio_filter_all_text' => 'portfolio_filter_all_text',

            // Service Details
            'service_related_projects_title' => 'service_related_projects_title',
            'services_link_text' => 'services_link_text',

            // Process Section (shared by services + service-details)
            'process_section_label' => 'process_section_label',
            'process_section_heading' => 'process_section_heading',
            'process_step_1_title' => 'process_step_1_title',
            'process_step_1_description' => 'process_step_1_description',
            'process_step_2_title' => 'process_step_2_title',
            'process_step_2_description' => 'process_step_2_description',
            'process_step_3_title' => 'process_step_3_title',
            'process_step_3_description' => 'process_step_3_description',
            'process_step_4_title' => 'process_step_4_title',
            'process_step_4_description' => 'process_step_4_description',
            'process_step_5_title' => 'process_step_5_title',
            'process_step_5_description' => 'process_step_5_description',
            'process_step_6_title' => 'process_step_6_title',
            'process_step_6_description' => 'process_step_6_description',

            // Contact Page
            'contact_form_title' => 'contact_form_title',
            'contact_form_subtitle' => 'contact_form_subtitle',
            'contact_label_address' => 'contact_label_address',
            'contact_label_phone' => 'contact_label_phone',
            'contact_label_email' => 'contact_label_email',
            'contact_label_social' => 'contact_label_social',
            'contact_fallback_phone' => 'contact_fallback_phone',
            'contact_fallback_email' => 'contact_fallback_email',
            'contact_submit_text' => 'contact_submit_text',
            'contact_field_name' => 'contact_field_name',
            'contact_field_email' => 'contact_field_email',
            'contact_field_phone' => 'contact_field_phone',
            'contact_field_subject' => 'contact_field_subject',
            'contact_field_message' => 'contact_field_message',

            // FAQ
            'faq_title' => 'faq_title',
            'faq_intro_text' => 'faq_intro_text',

            // Blog
            'blog_read_more_text' => 'blog_read_more_text',
            'blog_tags_label' => 'blog_tags_label',
            'blog_related_title' => 'blog_related_title',

            // Team
            'team_contact_info_title' => 'team_contact_info_title',
            'team_testimonials_title' => 'team_testimonials_title',

            // Navigation & Footer
            'navbar_cta_text' => 'navbar_cta_text',
            'footer_links_title' => 'footer_links_title',
            'footer_services_title' => 'footer_services_title',
            'footer_contact_title' => 'footer_contact_title',
            'footer_support_label' => 'footer_support_label',
            'cta_heading' => 'cta_heading',
            'cta_description' => 'cta_description',
            'cta_button_text' => 'cta_button_text',
            'footer_newsletter_title' => 'footer_newsletter_title',
            'footer_newsletter_disclaimer' => 'footer_newsletter_disclaimer',
            'marquee_text' => 'marquee_text',

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

            'contact_breadcrumb_title' => 'contact_breadcrumb_title',
            'contact_meta_description' => 'contact_meta_description',

            // FAQ Schema Scripts (Page-wise)
            'home_faq_schema' => 'home_faq_schema',
            'about_faq_schema' => 'about_faq_schema',
            'services_page_faq_schema' => 'services_page_faq_schema',
            'portfolio_page_faq_schema' => 'portfolio_page_faq_schema',
            'blog_page_faq_schema' => 'blog_page_faq_schema',
            'contact_faq_schema' => 'contact_faq_schema',
            'faq_page_faq_schema' => 'faq_page_faq_schema',
            'team_page_faq_schema' => 'team_page_faq_schema',
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
            'contact_image',
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
