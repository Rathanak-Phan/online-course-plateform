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
        Schema::table('users', function (Blueprint $table) {
            $table->string('headline')->nullable()->after('name');
            $table->text('bio')->nullable()->after('headline');
            $table->string('website')->nullable()->after('bio');
            $table->string('twitter')->nullable()->after('website');
            $table->string('linkedin')->nullable()->after('twitter');
            $table->string('youtube')->nullable()->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['headline', 'bio', 'website', 'twitter', 'linkedin', 'youtube']);
        });
    }
};
