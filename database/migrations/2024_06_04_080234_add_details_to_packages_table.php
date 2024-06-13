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
        Schema::table('packages', function (Blueprint $table) {
            $table->after('validity', function (Blueprint $table) {
                $table->tinyText('short_description')->nullable();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->boolean('status')->default(1);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn([
                'short_description',
                'description',
                'image',
                'status'
            ]);
        });
    }
};
