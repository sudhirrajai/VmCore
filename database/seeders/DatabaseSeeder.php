<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Client;
use App\Models\Faq;
use App\Models\HeroSection;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\Tag;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ───────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@vmcore.in'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // ── Site Settings ────────────────────────────────────────
        $settings = [
            'site_name' => 'VMCore',
            'site_email' => 'hello@vmcore.in',
            'site_phone' => '+1 800 123 654 987',
            'site_address' => '27 Division St, New York, NY 10002, USA',
            'meta_title' => 'VMCore - Creative Digital Agency',
            'meta_description' => 'We build creative digital experiences that drive growth and engage audiences worldwide.',
            'meta_keywords' => 'digital agency, web development, branding, creative, design',
            'about_title' => 'We Are VMCore — A Creative Digital Agency',
            'about_description' => 'We believe that building great things starts with a deep understanding of people and a commitment to quality. Our team brings together strategy, design, and technology to craft experiences that matter.',
            'google_map_embed' => 'https://maps.google.com/maps?q=New+York&t=m&z=12&output=embed&iwloc=near',
            'marquee_text' => 'We Give Unparalleled Flexibility',
            'video_url' => 'https://www.youtube.com/watch?v=vvNwlRLjLkU',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // ── Social Links ─────────────────────────────────────────
        $socialLinks = [
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/vmcore', 'icon_class' => 'fab fa-facebook-f', 'order' => 1],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/vmcore', 'icon_class' => 'fab fa-instagram', 'order' => 2],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/vmcore', 'icon_class' => 'fab fa-twitter', 'order' => 3],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/company/vmcore', 'icon_class' => 'fab fa-linkedin-in', 'order' => 4],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                array_merge($link, ['status' => true])
            );
        }

        // ── Hero Section ─────────────────────────────────────────
        HeroSection::updateOrCreate(
            ['title' => "We Make\nCreative Things\nEveryday"],
            [
                'subtitle' => 'We are a digital agency that helps build immersive and engaging user experiences that drive results.',
                'button_text' => 'VIEW OUR WORKS',
                'button_url' => '/portfolio',
                'status' => true,
                'order' => 1,
            ]
        );

        // ── Skills ───────────────────────────────────────────────
        $skills = [
            ['title' => 'Branding', 'percentage' => 86, 'order' => 1],
            ['title' => 'Development', 'percentage' => 92, 'order' => 2],
            ['title' => 'UI/UX Design', 'percentage' => 78, 'order' => 3],
            ['title' => 'Digital Marketing', 'percentage' => 85, 'order' => 4],
            ['title' => 'SEO Optimization', 'percentage' => 74, 'order' => 5],
            ['title' => 'Cloud Architecture', 'percentage' => 88, 'order' => 6],
            ['title' => 'Mobile Development', 'percentage' => 81, 'order' => 7],
            ['title' => 'Data Analytics', 'percentage' => 76, 'order' => 8],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['title' => $skill['title']],
                array_merge($skill, ['status' => true])
            );
        }

        // ── Services ─────────────────────────────────────────────
        $services = [
            ['title' => 'Branding Design', 'short_description' => 'We build powerful brand identities that stand out in the market and leave lasting impressions on your audience.', 'description' => '<p>Our branding process starts with deep research into your market, audience, and competitors. We craft visual identities, brand guidelines, and communication strategies that resonate with your target market.</p><p>From logo design to complete brand ecosystems, we ensure consistency across every touchpoint.</p>', 'icon' => 'fas fa-palette', 'order' => 1],
            ['title' => 'Web Development', 'short_description' => 'Custom-built websites and web applications using cutting-edge technologies for optimal performance and scalability.', 'description' => '<p>We specialize in building modern, high-performance websites and web applications. Our development stack includes Laravel, React, Vue.js, and other industry-leading frameworks.</p><p>Every project is built with scalability, security, and user experience at its core.</p>', 'icon' => 'fas fa-code', 'order' => 2],
            ['title' => 'Digital Marketing', 'short_description' => 'Data-driven digital marketing strategies that increase visibility, drive traffic, and convert visitors into customers.', 'description' => '<p>Our digital marketing team combines SEO, PPC, content marketing, and social media strategies to create comprehensive campaigns that deliver measurable results.</p>', 'icon' => 'fas fa-chart-line', 'order' => 3],
            ['title' => 'UI/UX Design', 'short_description' => 'User-centered design that combines aesthetics with functionality to create seamless digital experiences.', 'description' => '<p>We follow a research-driven design process to create interfaces that users love. From wireframes to high-fidelity prototypes, we iterate until the experience is perfect.</p>', 'icon' => 'fas fa-pencil-ruler', 'order' => 4],
            ['title' => 'Mobile App Development', 'short_description' => 'Native and cross-platform mobile applications built for iOS and Android with focus on performance.', 'description' => '<p>Our mobile development team builds high-quality apps using React Native and Flutter for cross-platform reach, as well as native Swift and Kotlin for maximum performance.</p>', 'icon' => 'fas fa-mobile-alt', 'order' => 5],
            ['title' => 'Cloud Solutions', 'short_description' => 'Scalable cloud infrastructure and DevOps solutions that power modern businesses.', 'description' => '<p>We help organizations migrate to the cloud, optimize their infrastructure, and implement CI/CD pipelines for seamless deployment workflows.</p>', 'icon' => 'fas fa-cloud', 'order' => 6],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(
                ['title' => $s['title']],
                array_merge($s, ['slug' => Str::slug($s['title']), 'status' => true])
            );
        }

        // ── Project Categories ───────────────────────────────────
        $projectCategories = [
            ['title' => 'Web Design', 'order' => 1],
            ['title' => 'Mobile Apps', 'order' => 2],
            ['title' => 'Branding', 'order' => 3],
        ];

        foreach ($projectCategories as $cat) {
            ProjectCategory::updateOrCreate(
                ['title' => $cat['title']],
                array_merge($cat, ['slug' => Str::slug($cat['title']), 'status' => true])
            );
        }

        // ── Projects ─────────────────────────────────────────────
        $categories = ProjectCategory::all();
        $serviceModels = Service::all();

        $projects = [
            ['title' => 'Catalyst Finance Platform', 'short_description' => 'A comprehensive fintech dashboard with real-time analytics and portfolio management.', 'description' => '<p>Catalyst Finance is a next-generation financial technology platform that provides real-time market data, portfolio analytics, and automated trading signals for professional investors.</p>', 'client' => 'Catalyst Corp', 'category_idx' => 0, 'service_idx' => 1],
            ['title' => 'Bloom E-Commerce', 'short_description' => 'Modern e-commerce platform with AI-powered recommendations and seamless checkout.', 'description' => '<p>Bloom is a feature-rich e-commerce platform built for growing businesses. It includes AI-powered product recommendations, a streamlined checkout flow, and comprehensive inventory management.</p>', 'client' => 'Bloom Retail', 'category_idx' => 0, 'service_idx' => 1],
            ['title' => 'Velo Fitness App', 'short_description' => 'Cross-platform fitness tracking app with social features and workout plans.', 'description' => '<p>Velo is a fitness companion app that combines workout tracking, nutrition logging, and social challenges to keep users motivated on their fitness journey.</p>', 'client' => 'Velo Health', 'category_idx' => 1, 'service_idx' => 4],
            ['title' => 'Nexus Brand Identity', 'short_description' => 'Complete brand overhaul for a tech startup, including logo, guidelines, and collateral.', 'description' => '<p>We reimagined Nexus\'s brand from the ground up, creating a modern visual identity that reflects their innovative approach to enterprise software.</p>', 'client' => 'Nexus Solutions', 'category_idx' => 2, 'service_idx' => 0],
            ['title' => 'Aether SaaS Dashboard', 'short_description' => 'Enterprise SaaS analytics dashboard with real-time data visualization.', 'description' => '<p>Aether is a powerful analytics platform offering real-time dashboards, custom reports, and data-driven insights for enterprise clients.</p>', 'client' => 'Aether Analytics', 'category_idx' => 0, 'service_idx' => 1],
            ['title' => 'Zephyr Travel App', 'short_description' => 'Travel planning and booking app with personalized itinerary suggestions.', 'description' => '<p>Zephyr makes travel planning effortless with smart itinerary suggestions, local recommendations, and seamless booking integration.</p>', 'client' => 'Zephyr Travels', 'category_idx' => 1, 'service_idx' => 4],
            ['title' => 'Aurora Wellness Branding', 'short_description' => 'Serene and modern branding for a wellness and meditation company.', 'description' => '<p>Aurora\'s brand identity captures the calm and clarity of their wellness philosophy with a soothing color palette and organic design elements.</p>', 'client' => 'Aurora Wellness', 'category_idx' => 2, 'service_idx' => 0],
            ['title' => 'Prism Media Portal', 'short_description' => 'Content management and media distribution platform for media companies.', 'description' => '<p>Prism is a centralized media portal that streamlines content creation, approval workflows, and multi-channel distribution for media organizations.</p>', 'client' => 'Prism Media Group', 'category_idx' => 0, 'service_idx' => 1],
        ];

        $order = 1;
        foreach ($projects as $p) {
            Project::updateOrCreate(
                ['title' => $p['title']],
                [
                    'slug' => Str::slug($p['title']),
                    'short_description' => $p['short_description'],
                    'description' => $p['description'],
                    'client' => $p['client'],
                    'category_id' => $categories[$p['category_idx']]->id ?? null,
                    'service_id' => $serviceModels[$p['service_idx']]->id ?? null,
                    'status' => true,
                    'order' => $order++,
                ]
            );
        }

        // ── Tags ─────────────────────────────────────────────────
        $tagNames = ['Laravel', 'React', 'Design', 'Mobile', 'Cloud', 'Branding', 'UI/UX', 'E-commerce'];
        foreach ($tagNames as $name) {
            Tag::updateOrCreate(['title' => $name], ['slug' => Str::slug($name)]);
        }

        // ── Blog Categories ──────────────────────────────────────
        $blogCategories = [
            ['title' => 'Technology', 'order' => 1],
            ['title' => 'Design', 'order' => 2],
            ['title' => 'Business', 'order' => 3],
        ];

        foreach ($blogCategories as $cat) {
            BlogCategory::updateOrCreate(
                ['title' => $cat['title']],
                array_merge($cat, ['slug' => Str::slug($cat['title']), 'status' => true])
            );
        }

        // ── Blog Posts ───────────────────────────────────────────
        $blogCats = BlogCategory::all();
        $admin = User::first();

        $blogPosts = [
            ['title' => '10 Web Design Trends Shaping the Future', 'excerpt' => 'Discover the latest web design trends that are redefining how brands connect with their audiences online.', 'body' => '<p>The web design landscape is constantly evolving, with new trends emerging every year. In this article, we explore the top 10 design trends that are shaping the future of digital experiences.</p><h3>1. Dark Mode</h3><p>Dark mode continues to grow in popularity, offering reduced eye strain and a sleek, modern aesthetic.</p><h3>2. Micro-interactions</h3><p>Small, purposeful animations that guide users and provide feedback are increasingly important.</p><h3>3. 3D Elements</h3><p>Three-dimensional design elements add depth and immersion to flat interfaces.</p>', 'category_idx' => 1, 'published_at' => now()->subDays(3)],
            ['title' => 'The Role of AI in Modern Software Development', 'excerpt' => 'How artificial intelligence is transforming the way software is built, tested, and deployed.', 'body' => '<p>Artificial intelligence is no longer just a buzzword — it\'s fundamentally changing the software development lifecycle.</p><h3>Code Generation</h3><p>AI-powered tools can now assist developers in writing code faster and with fewer bugs.</p><h3>Automated Testing</h3><p>Machine learning algorithms can identify test cases and predict areas of code most likely to contain bugs.</p>', 'category_idx' => 0, 'published_at' => now()->subDays(7)],
            ['title' => 'Building Scalable Applications with Laravel', 'excerpt' => 'A comprehensive guide to building enterprise-grade applications using the Laravel framework.', 'body' => '<p>Laravel remains one of the most popular PHP frameworks for building robust web applications. In this guide, we cover the key principles and patterns for building scalable Laravel applications.</p><h3>Service Layer Pattern</h3><p>Separating business logic into service classes keeps controllers lean and testable.</p><h3>Queue Workers</h3><p>Offloading heavy processing to background jobs improves response times.</p>', 'category_idx' => 0, 'published_at' => now()->subDays(14)],
            ['title' => 'How Branding Drives Business Growth', 'excerpt' => 'Understanding the connection between strong branding and sustainable business growth.', 'body' => '<p>A strong brand is more than a logo — it\'s the perception people hold about your company. In this article, we explore how investing in branding translates directly to business growth.</p><h3>Brand Recognition</h3><p>Consistent branding across all touchpoints builds trust and familiarity.</p>', 'category_idx' => 2, 'published_at' => now()->subDays(21)],
            ['title' => 'UX Research Methods Every Designer Should Know', 'excerpt' => 'Essential user experience research methods to create products people love.', 'body' => '<p>Great design starts with understanding your users. Here are the essential UX research methods every designer should have in their toolkit.</p><h3>User Interviews</h3><p>One-on-one conversations reveal deep insights about user needs and pain points.</p><h3>Usability Testing</h3><p>Observing users interact with your product highlights friction points and opportunities.</p>', 'category_idx' => 1, 'published_at' => now()->subDays(30)],
            ['title' => 'The Complete Guide to SEO in 2025', 'excerpt' => 'Everything you need to know about search engine optimization to drive organic traffic.', 'body' => '<p>SEO continues to be one of the most cost-effective marketing channels. This guide covers everything from keyword research to technical SEO.</p><h3>Core Web Vitals</h3><p>Page speed and user experience signals are now major ranking factors.</p><h3>Content Authority</h3><p>Creating comprehensive, authoritative content remains the foundation of SEO success.</p>', 'category_idx' => 2, 'published_at' => now()->subDays(5)],
        ];

        foreach ($blogPosts as $post) {
            BlogPost::updateOrCreate(
                ['title' => $post['title']],
                [
                    'slug' => Str::slug($post['title']),
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'category_id' => $blogCats[$post['category_idx']]->id ?? null,
                    'user_id' => $admin?->id,
                    'published_at' => $post['published_at'],
                    'status' => true,
                ]
            );
        }

        // ── Team Members ─────────────────────────────────────────
        $teamMembers = [
            ['name' => 'Raj Kumar', 'designation' => 'CEO & Founder', 'bio' => '<p>Raj brings over 15 years of experience in digital strategy and business development. He founded VMCore with a vision to bridge the gap between technology and creative excellence.</p>', 'email' => 'raj@vmcore.in', 'social_links' => ['linkedin' => 'https://linkedin.com', 'twitter' => 'https://twitter.com'], 'order' => 1],
            ['name' => 'Priya Sharma', 'designation' => 'Lead Designer', 'bio' => '<p>Priya is an award-winning designer with a passion for creating beautiful, user-centered interfaces. She leads our design team in crafting memorable digital experiences.</p>', 'email' => 'priya@vmcore.in', 'social_links' => ['linkedin' => 'https://linkedin.com', 'dribbble' => 'https://dribbble.com'], 'order' => 2],
            ['name' => 'Arjun Patel', 'designation' => 'Tech Lead', 'bio' => '<p>Arjun is a full-stack developer with deep expertise in Laravel, Vue.js, and cloud architecture. He ensures every project meets the highest technical standards.</p>', 'email' => 'arjun@vmcore.in', 'social_links' => ['linkedin' => 'https://linkedin.com', 'github' => 'https://github.com'], 'order' => 3],
            ['name' => 'Meera Nair', 'designation' => 'Marketing Director', 'bio' => '<p>Meera drives our digital marketing strategy, combining data analytics with creative storytelling to maximize our clients\' reach and engagement.</p>', 'email' => 'meera@vmcore.in', 'social_links' => ['linkedin' => 'https://linkedin.com', 'twitter' => 'https://twitter.com'], 'order' => 4],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                array_merge($member, ['slug' => Str::slug($member['name']), 'status' => true])
            );
        }

        // ── Testimonials ─────────────────────────────────────────
        $testimonials = [
            ['name' => 'Sarah Johnson', 'designation' => 'CEO', 'company' => 'Catalyst Corp', 'content' => 'VMCore transformed our digital presence with a stunning platform that exceeded all expectations. Their attention to detail and strategic thinking set them apart.', 'rating' => 5, 'order' => 1],
            ['name' => 'Michael Chen', 'designation' => 'CTO', 'company' => 'Bloom Retail', 'content' => 'Working with VMCore was a game-changer. They delivered a scalable e-commerce solution that increased our conversion rate by 40% in just three months.', 'rating' => 5, 'order' => 2],
            ['name' => 'Emily Rodriguez', 'designation' => 'Marketing VP', 'company' => 'Nexus Solutions', 'content' => 'The branding work VMCore did for us perfectly captured our company vision. Their creative process is thorough, collaborative, and results-driven.', 'rating' => 5, 'order' => 3],
            ['name' => 'David Kim', 'designation' => 'Founder', 'company' => 'Velo Health', 'content' => 'Our fitness app has been a massive success thanks to VMCore\'s thoughtful UX design and robust engineering. Users love the intuitive interface.', 'rating' => 4, 'order' => 4],
            ['name' => 'Lisa Wang', 'designation' => 'Director', 'company' => 'Aurora Wellness', 'content' => 'VMCore created a brand identity that truly resonates with our audience. The serenity and clarity they brought to our visual language is remarkable.', 'rating' => 5, 'order' => 5],
            ['name' => 'Tom Andrews', 'designation' => 'COO', 'company' => 'Prism Media Group', 'content' => 'The media portal VMCore built streamlined our entire content workflow. We\'ve cut our publishing time in half and improved team collaboration significantly.', 'rating' => 5, 'order' => 6],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                array_merge($t, ['status' => true])
            );
        }

        // ── Awards ───────────────────────────────────────────────
        $awards = [
            ['title' => 'Best Digital Agency', 'description' => 'Recognized for outstanding work in digital transformation and creative excellence.', 'year' => 2023, 'tag' => 'Innovation', 'order' => 1],
            ['title' => 'Web Excellence Award', 'description' => 'Awarded for delivering exceptional web design and development projects.', 'year' => 2024, 'tag' => 'Web Design', 'order' => 2],
            ['title' => 'Brand Strategy Award', 'description' => 'Honored for creating a transformative brand identity for a Fortune 500 client.', 'year' => 2024, 'tag' => 'Branding', 'order' => 3],
            ['title' => 'Mobile App of the Year', 'description' => 'Velo Fitness app recognized for its innovative UX and engagement metrics.', 'year' => 2025, 'tag' => 'Mobile', 'order' => 4],
        ];

        foreach ($awards as $a) {
            Award::updateOrCreate(
                ['title' => $a['title']],
                array_merge($a, ['status' => true])
            );
        }

        // ── Clients ──────────────────────────────────────────────
        $clients = [
            ['name' => 'Catalyst Corp', 'url' => 'https://catalyst.com', 'order' => 1],
            ['name' => 'Bloom Retail', 'url' => 'https://bloom.com', 'order' => 2],
            ['name' => 'Nexus Solutions', 'url' => 'https://nexus.com', 'order' => 3],
            ['name' => 'Velo Health', 'url' => 'https://velohealth.com', 'order' => 4],
            ['name' => 'Aurora Wellness', 'url' => 'https://aurora.com', 'order' => 5],
            ['name' => 'Prism Media Group', 'url' => 'https://prismmedia.com', 'order' => 6],
            ['name' => 'Aether Analytics', 'url' => 'https://aether.io', 'order' => 7],
            ['name' => 'Zephyr Travels', 'url' => 'https://zephyr.travel', 'order' => 8],
        ];

        foreach ($clients as $c) {
            Client::updateOrCreate(
                ['name' => $c['name']],
                array_merge($c, ['status' => true])
            );
        }

        // ── FAQs ─────────────────────────────────────────────────
        $faqs = [
            ['question' => 'What services does VMCore offer?', 'answer' => 'We offer a comprehensive suite of digital services including web development, branding design, UI/UX design, digital marketing, mobile app development, and cloud solutions. Each service is tailored to your specific business goals.', 'order' => 1],
            ['question' => 'How long does a typical project take?', 'answer' => 'Project timelines vary based on scope and complexity. A branding project typically takes 4-6 weeks, a website 6-10 weeks, and a mobile app 8-16 weeks. We provide detailed timelines during our initial consultation.', 'order' => 2],
            ['question' => 'What is your design process?', 'answer' => 'Our process follows four key phases: Discovery (research and strategy), Design (wireframes and mockups), Development (building and testing), and Delivery (launch and optimization). We maintain close collaboration throughout every phase.', 'order' => 3],
            ['question' => 'Do you provide ongoing support after launch?', 'answer' => 'Yes! We offer comprehensive maintenance and support packages. These include security updates, performance monitoring, content updates, and feature enhancements to keep your project running smoothly.', 'order' => 4],
            ['question' => 'How do you handle project pricing?', 'answer' => 'We provide transparent, project-based pricing after understanding your requirements. We offer fixed-price quotes for well-defined projects and time-and-materials billing for projects with evolving scope. Free consultations are available to discuss your needs.', 'order' => 5],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, ['status' => true])
            );
        }
    }
}
