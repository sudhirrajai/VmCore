<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\pages\AccountSettingsAccount;
use App\Http\Controllers\Admin\pages\AccountSettingsNotifications;
use App\Http\Controllers\Admin\pages\AccountSettingsConnections;
use App\Http\Controllers\Admin\pages\MiscError;
use App\Http\Controllers\Admin\pages\MiscUnderMaintenance;
use App\Http\Controllers\Admin\authentications\LoginBasic;
use App\Http\Controllers\Admin\authentications\RegisterBasic;
use App\Http\Controllers\Admin\authentications\ForgotPasswordBasic;

// ============================================================
// PORTFOLIO CMS ADMIN PANEL — Routes
// ============================================================

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// ------------------------------------------------------------
// Content Management — Hero, Services, Skills
// ------------------------------------------------------------
Route::resource('hero-sections', HeroSectionController::class)->except(['show']);
Route::post('hero-sections/{heroSection}/toggle-status', [HeroSectionController::class, 'toggleStatus'])->name('hero-sections.toggle-status');

Route::resource('services', ServiceController::class)->except(['show']);
Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

Route::resource('skills', SkillController::class)->except(['show']);
Route::post('skills/{skill}/toggle-status', [SkillController::class, 'toggleStatus'])->name('skills.toggle-status');

// ------------------------------------------------------------
// Portfolio — Categories & Projects
// ------------------------------------------------------------
Route::resource('project-categories', ProjectCategoryController::class)->except(['show']);
Route::post('project-categories/{projectCategory}/toggle-status', [ProjectCategoryController::class, 'toggleStatus'])->name('project-categories.toggle-status');

Route::resource('projects', ProjectController::class)->except(['show']);
Route::post('projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggle-status');
Route::post('projects/bulk-delete', [ProjectController::class, 'bulkDelete'])->name('projects.bulk-delete');
Route::delete('projects/gallery/{id}', [ProjectController::class, 'deleteGalleryImage'])->name('projects.delete-gallery');

// ------------------------------------------------------------
// Blog — Categories & Posts
// ------------------------------------------------------------
Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);
Route::post('blog-categories/{blogCategory}/toggle-status', [BlogCategoryController::class, 'toggleStatus'])->name('blog-categories.toggle-status');

Route::resource('blog', BlogPostController::class)->except(['show']);
Route::post('blog/{blog}/toggle-status', [BlogPostController::class, 'toggleStatus'])->name('blog.toggle-status');

// ------------------------------------------------------------
// Team & Testimonials
// ------------------------------------------------------------
Route::resource('team', TeamMemberController::class)->except(['show']);
Route::post('team/{team}/toggle-status', [TeamMemberController::class, 'toggleStatus'])->name('team.toggle-status');

Route::resource('testimonials', TestimonialController::class)->except(['show']);
Route::post('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');

// ------------------------------------------------------------
// Awards, Clients, FAQs
// ------------------------------------------------------------
Route::resource('awards', AwardController::class)->except(['show']);
Route::post('awards/{award}/toggle-status', [AwardController::class, 'toggleStatus'])->name('awards.toggle-status');

Route::resource('clients', ClientController::class)->except(['show']);
Route::post('clients/{client}/toggle-status', [ClientController::class, 'toggleStatus'])->name('clients.toggle-status');

Route::resource('faqs', FaqController::class)->except(['show']);
Route::post('faqs/{faq}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faqs.toggle-status');

// ------------------------------------------------------------
// Inquiries & Newsletter
// ------------------------------------------------------------
Route::resource('inquiries', ContactSubmissionController::class)->only(['index', 'show', 'destroy']);
Route::post('inquiries/{inquiry}/mark-read', [ContactSubmissionController::class, 'markAsRead'])->name('inquiries.mark-read');

Route::resource('newsletter', NewsletterController::class)->only(['index', 'destroy']);
Route::get('newsletter/export', [NewsletterController::class, 'export'])->name('newsletter.export');

// ------------------------------------------------------------
// Social Links
// ------------------------------------------------------------
Route::resource('social-links', SocialLinkController::class)->except(['show']);
Route::post('social-links/{socialLink}/toggle-status', [SocialLinkController::class, 'toggleStatus'])->name('social-links.toggle-status');

// ------------------------------------------------------------
// Settings
// ------------------------------------------------------------
Route::prefix('settings')->name('settings.')->group(function () {
  Route::get('/', [SiteSettingController::class, 'index'])->name('index');
  Route::post('/update', [SiteSettingController::class, 'update'])->name('update');
  Route::post('/general', [SiteSettingController::class, 'updateGeneral'])->name('general.update');
  Route::get('/theme', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('theme');
  Route::post('/theme', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('theme.update');
});

// ============================================================
// ACCOUNT & AUTH PAGES — Kept for admin use
// ============================================================

// Account Settings
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');

// Error / Maintenance pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// Authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');


// ============================================================
// TEMPLATE DEMO ROUTES — NOT USED IN PORTFOLIO ADMIN
// Commented out — these are Sneat template demos only.
// Uncomment if you need to reference UI components.
// ============================================================

/*
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

Route::get('/layouts/without-menu',    [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar',  [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid',           [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container',       [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank',           [Blank::class, 'index'])->name('layouts-blank');
Route::get('/cards/basic',             [CardBasic::class, 'index'])->name('cards-basic');
Route::get('/ui/accordion',            [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts',               [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges',               [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons',              [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel',             [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse',             [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns',            [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer',               [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups',          [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals',               [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar',               [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas',            [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs',[PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress',             [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners',             [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills',           [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts',               [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers',    [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography',           [Typography::class, 'index'])->name('ui-typography');
Route::get('/extended/ui-perfect-scrollbar',[PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider',[TextDivider::class, 'index'])->name('extended-ui-text-divider');
Route::get('/icons/boxicons',          [Boxicons::class, 'index'])->name('icons-boxicons');
Route::get('/forms/basic-inputs',      [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups',      [InputGroups::class, 'index'])->name('forms-input-groups');
Route::get('/form/layouts-vertical',   [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');
Route::get('/tables/basic',            [TablesBasic::class, 'index'])->name('tables-basic');
*/