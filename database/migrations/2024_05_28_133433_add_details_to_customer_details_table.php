<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customer_details', function (Blueprint $table) {

            $table->after('profession', function (Blueprint $table) {
                $table->string('state')->nullable();
                $table->string('district')->nullable();
                $table->string('city')->nullable();
                $table->string('religion')->nullable();
                $table->string('cast')->nullable();
                $table->float('income', 10, 2)->nullable();
            });
            $table->string('customer_id')->nullable()->after('user_id');
            $table->string('images')->nullable()->after('profile_image');
            $table->boolean('profile_completed')->default(false)->after('sign_up_method');
            $table->boolean('is_banned')->default(false)->after('profile_completed');

            $table->integer('views')->default(0)->after('sign_up_method');
            $table->integer('likes')->default(0)->after('views');

            DB::statement("ALTER TABLE customer_details CHANGE blood_group blood_group VARCHAR(191) NOT NULL AFTER profession");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->dropColumn([
                'images',
                'profile_completed',
                'state',
                'district',
                'city',
                'religion',
                'cast',
                'income',
            ]);
        });
    }
};
