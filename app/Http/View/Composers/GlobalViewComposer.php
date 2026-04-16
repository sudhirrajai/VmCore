<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\SettingService;
use App\Services\MenuService;
use App\Enums\MenuLocationEnum;

class GlobalViewComposer
{
    protected $settingService;
    protected $menuService;

    public function __construct(SettingService $settingService, MenuService $menuService)
    {
        $this->settingService = $settingService;
        $this->menuService = $menuService;
    }

    public function compose(View $view)
    {
        $socialLinks = \App\Models\SocialLink::where('status', true)->orderBy('order', 'asc')->get();

        $view->with('siteSettings', [
            'site_name' => $this->settingService->get('site_name', 'VMCore'),
            'logo' => $this->settingService->get('logo', 'assets/img/logo.svg'),
            'logo_white' => $this->settingService->get('logo_white', 'assets/img/logo-white-sm.svg'),
            'favicon' => $this->settingService->get('favicon'),
            'footer_logo' => $this->settingService->get('footer_logo'),
            'footer_text' => $this->settingService->get('footer_text'),
            'site_email' => $this->settingService->get('contact_email'),
            'site_phone' => $this->settingService->get('phone'),
            'site_address' => $this->settingService->get('address'),
            'site_description' => $this->settingService->get('site_description', $this->settingService->get('default_meta_description', '')),
            'og_image' => $this->settingService->get('og_image', $this->settingService->get('logo', '')),
            'social_links' => $socialLinks,
            'default_meta_title' => $this->settingService->get('default_meta_title'),
            'default_meta_description' => $this->settingService->get('default_meta_description'),
            'meta_keywords' => $this->settingService->get('meta_keywords'),
            // Individual social URLs for contact page
            'facebook_url' => $this->settingService->get('facebook_url'),
            'twitter_url' => $this->settingService->get('twitter_url'),
            'instagram_url' => $this->settingService->get('instagram_url'),
            'linkedin_url' => $this->settingService->get('linkedin_url'),
            'youtube_url' => $this->settingService->get('youtube_url'),
        ]);

        $view->with('socialLinks', $socialLinks);

        $view->with('headerMenu', $this->menuService->getMenuByLocation(MenuLocationEnum::HEADER));
        $view->with('footerMenu', $this->menuService->getMenuByLocation(MenuLocationEnum::FOOTER));
        $view->with('sidebarMenu', $this->menuService->getMenuByLocation(MenuLocationEnum::SIDEBAR));
    }
}
