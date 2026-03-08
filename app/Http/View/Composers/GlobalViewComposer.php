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
            'social_links' => json_decode($this->settingService->get('social_links', '[]')),
            'default_meta_title' => $this->settingService->get('default_meta_title'),
            'default_meta_description' => $this->settingService->get('default_meta_description'),
            'meta_keywords' => $this->settingService->get('meta_keywords'),
        ]);

        $socialLinksInfo = json_decode($this->settingService->get('social_links', '[]'));
        $view->with('socialLinks', is_array($socialLinksInfo) ? $socialLinksInfo : []);

        $view->with('headerMenu', $this->menuService->getMenuByLocation(MenuLocationEnum::HEADER));
        $view->with('footerMenu', $this->menuService->getMenuByLocation(MenuLocationEnum::FOOTER));
        $view->with('sidebarMenu', $this->menuService->getMenuByLocation(MenuLocationEnum::SIDEBAR));
    }
}
