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
        // Add total_visitors to galery table
        Schema::table('galery', function (Blueprint $table) {
            if (!Schema::hasColumn('galery', 'total_visitors')) {
                $table->unsignedInteger('total_visitors')->default(0)->after('total_downloads');
            }
        });

        // Add total_visitors to posts table
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'total_visitors')) {
                $table->unsignedInteger('total_visitors')->default(0)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galery', function (Blueprint $table) {
            if (Schema::hasColumn('galery', 'total_visitors')) {
                $table->dropColumn('total_visitors');
            }
        });

        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'total_visitors')) {
                $table->dropColumn('total_visitors');
            }
        });
    }
};
