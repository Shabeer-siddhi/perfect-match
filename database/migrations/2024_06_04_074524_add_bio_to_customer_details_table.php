<?php

use App\Models\Subscription\Packages;
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
        Schema::table('customer_details', function (Blueprint $table) {

            $table->after('images', function (Blueprint $table) {
                $table->tinyText('short_bio')->nullable();
                $table->text('bio')->nullable();

                $table->foreignIdFor(Packages::class);
                $table->dateTime('package_expiry')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->dropColumn([
                'short_bio',
                'bio',
                'packages_id',
                'package_expiry',
            ]);
            $table->dropForeignIdFor(Packages::class);
        });
    }
};
