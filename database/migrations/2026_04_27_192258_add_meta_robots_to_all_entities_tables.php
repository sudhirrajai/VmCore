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
        $tables = ['pages', 'projects', 'services', 'blog_posts', 'team_members'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('meta_robots')->nullable()->after('meta_description');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['pages', 'projects', 'services', 'blog_posts', 'team_members'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('meta_robots');
            });
        }
    }
};
