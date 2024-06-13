<?php

use App\Models\Location\City;
use App\Models\Location\District;
use App\Models\Location\State;
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
            $table->dropColumn([
                'state',
                'district',
                'city'
            ]);
            $table->after('profession', function (Blueprint $table) {
                $table->foreignIdFor(State::class);
                $table->foreignIdFor(City::class);
                $table->foreignIdFor(District::class);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->after('profession', function (Blueprint $table) {
                $table->string('state')->nullable();
                $table->string('district')->nullable();
                $table->string('city')->nullable();
            });
        });
    }
};
