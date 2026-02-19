<?php

namespace App\Http\Controllers\Admin\portfolio;

use App\Http\Controllers\Controller;

class PortfolioAdminController extends Controller
{
  /**
   * Portfolio Admin Dashboard — stats overview
   */
  public function dashboard()
  {
    return view('content.portfolio.dashboard');
  }

  /**
   * Manage Projects
   */
  public function projects()
  {
    return view('content.portfolio.projects');
  }

  /**
   * Manage Services
   */
  public function services()
  {
    return view('content.portfolio.services');
  }

  /**
   * Manage Case Studies
   */
  public function caseStudies()
  {
    return view('content.portfolio.case-studies');
  }

  /**
   * Manage Testimonials
   */
  public function testimonials()
  {
    return view('content.portfolio.testimonials');
  }

  /**
   * Manage Team Members
   */
  public function team()
  {
    return view('content.portfolio.team');
  }

  /**
   * Manage Blog Posts
   */
  public function blog()
  {
    return view('content.portfolio.blog');
  }

  /**
   * View Contact Inquiries
   */
  public function inquiries()
  {
    return view('content.portfolio.inquiries');
  }

  /**
   * Manage Job Listings / Careers
   */
  public function careers()
  {
    return view('content.portfolio.careers');
  }
}
