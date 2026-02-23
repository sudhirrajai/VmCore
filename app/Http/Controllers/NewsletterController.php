<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function unsubscribe(Request $request, $email, $token)
    {
        $result = $this->newsletterService->processUnsubscribe($email, $token);

        if ($result) {
            return view('frontend.newsletter.unsubscribe_success');
        }

        return view('frontend.newsletter.unsubscribe_failed');
    }
}
