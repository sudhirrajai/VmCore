<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

// ── Frontend Routes ──────────────────────────────────────────
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/services/{service:slug}', [FrontendController::class, 'serviceDetail'])->name('service.detail');
Route::get('/team', [FrontendController::class, 'team'])->name('team');
Route::get('/team/{member:slug}', [FrontendController::class, 'teamDetail'])->name('team.detail');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{project:slug}', [FrontendController::class, 'portfolioDetail'])->name('portfolio.detail');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{post:slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');
Route::post('/newsletter/subscribe', [FrontendController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');
Route::get('/unsubscribe/{email}/{token}', [\App\Http\Controllers\NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

Route::get('/error', fn() => view('error'))->name('error');

// ── SEO Routes ───────────────────────────────────────────────
Route::get('/sitemap.xml', [\App\Http\Controllers\SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [\App\Http\Controllers\SeoController::class, 'robots'])->name('robots');

// ── Dynamic CMS Pages ────────────────────────────────────────
Route::fallback([FrontendController::class, 'page'])->name('page');
