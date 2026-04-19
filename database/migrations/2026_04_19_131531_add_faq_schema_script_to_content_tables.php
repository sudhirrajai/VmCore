<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('faq_schema_script')->nullable()->after('meta_keywords');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->text('faq_schema_script')->nullable()->after('meta_description');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->text('faq_schema_script')->nullable()->after('meta_description');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->text('faq_schema_script')->nullable()->after('meta_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('faq_schema_script');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('faq_schema_script');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('faq_schema_script');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('faq_schema_script');
        });
    }
};
