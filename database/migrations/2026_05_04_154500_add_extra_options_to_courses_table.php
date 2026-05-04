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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('language')->default('English')->after('level');
            $table->string('duration')->nullable()->after('language');
            $table->text('requirements')->nullable()->after('description');
            $table->text('what_will_learn')->nullable()->after('requirements');
            $table->text('target_audience')->nullable()->after('what_will_learn');
            $table->boolean('has_certificate')->default(true)->after('duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'language',
                'duration',
                'requirements',
                'what_will_learn',
                'target_audience',
                'has_certificate'
            ]);
        });
    }
};
