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
        // SQLite doesn't support change(), so we need to recreate the column
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            // For SQLite, we'll drop and recreate
            // Note: This requires dropping foreign key constraints first
            Schema::table('posts', function (Blueprint $table) {
                $table->dropForeign(['petugas_id']);
                $table->dropColumn('petugas_id');
            });
            
            Schema::table('posts', function (Blueprint $table) {
                $table->foreignId('petugas_id')->nullable()->constrained('petugas')->onDelete('cascade');
            });

            Schema::table('galery', function (Blueprint $table) {
                $table->dropColumn('position');
            });
            
            Schema::table('galery', function (Blueprint $table) {
                $table->integer('position')->default(0);
            });
        } else {
            // For MySQL/PostgreSQL, use change()
            Schema::table('posts', function (Blueprint $table) {
                $table->foreignId('petugas_id')->nullable()->change();
            });

            Schema::table('galery', function (Blueprint $table) {
                $table->integer('position')->default(0)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('petugas_id')->nullable(false)->change();
        });

        // Revert galery table
        Schema::table('galery', function (Blueprint $table) {
            $table->integer('position')->nullable(false)->change();
        });
    }
};
