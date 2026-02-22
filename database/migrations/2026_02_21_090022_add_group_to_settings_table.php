<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Enhance the existing settings table to support grouping
        if (!Schema::hasColumn('settings', 'group')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('group')->default('general')->after('value');
                $table->string('type')->default('text')->after('group');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('settings', 'group')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn(['group', 'type']);
            });
        }
    }
};
