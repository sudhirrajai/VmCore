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
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\authentications\LoginBasic;

// ============================================================
// AUTHENTICATION (public — no middleware)
// ============================================================
Route::get('/login', [LoginBasic::class, 'index'])->name('login');
Route::post('/login', [LoginBasic::class, 'login'])->name('login.post');

// Forgot & Reset Password Routes
Route::get('/forgot-password', [\App\Http\Controllers\Admin\authentications\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\Admin\authentications\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\Admin\authentications\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\Admin\authentications\ResetPasswordController::class, 'reset'])->name('password.update');

// ============================================================
// ALL ADMIN ROUTES — Protected by auth middleware
// ============================================================
Route::middleware('auth')->group(function () {

  // Logout
  Route::post('/logout', [LoginBasic::class, 'logout'])->name('logout');

  // Dashboard
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

  // Global Search
  Route::get('/search', [SearchController::class, 'search'])->name('search');

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
  // CMS Pages & Menus
  // ------------------------------------------------------------
  Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);

  Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class)->except(['show']);
  Route::get('menus/{menu}/builder', [\App\Http\Controllers\Admin\MenuController::class, 'items'])->name('menus.builder');
  Route::post('menus/{menu}/items', [\App\Http\Controllers\Admin\MenuController::class, 'storeItem'])->name('menus.items.store');
  Route::delete('menu-items/{item}', [\App\Http\Controllers\Admin\MenuController::class, 'destroyItem'])->name('menus.items.destroy');
  Route::post('menus/{menu}/reorder', [\App\Http\Controllers\Admin\MenuController::class, 'reorderList'])->name('menus.reorder');

  // ------------------------------------------------------------
  // Settings
  // ------------------------------------------------------------
  Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\GlobalSettingController::class, 'index'])->name('index');
    Route::post('/update', [\App\Http\Controllers\Admin\GlobalSettingController::class, 'update'])->name('update');

    Route::get('/frontend', [\App\Http\Controllers\Admin\FrontendContentController::class, 'index'])->name('frontend');
    Route::post('/frontend', [\App\Http\Controllers\Admin\FrontendContentController::class, 'update'])->name('frontend.update');

    Route::get('/theme', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('theme');
    Route::post('/theme', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('theme.update');

    Route::get('/smtp', [\App\Http\Controllers\Admin\SmtpSettingController::class, 'index'])->name('smtp');
    Route::post('/smtp/update', [\App\Http\Controllers\Admin\SmtpSettingController::class, 'update'])->name('smtp.update');
    Route::post('/smtp/test', [\App\Http\Controllers\Admin\SmtpSettingController::class, 'test'])->name('smtp.test');
  });
});