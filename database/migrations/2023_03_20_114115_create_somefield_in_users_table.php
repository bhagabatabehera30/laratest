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
             $table->integer('role_id')->unsigned()->nullable()->after('password');
             $table->string('country_id',10)->nullable()->after('role_id');
             $table->string('country_code',10)->nullable()->after('country_id');
             $table->string('mobile',15)->nullable()->after('country_code');
             $table->string('otp',10)->nullable()->after('mobile');
             $table->timestamp('otp_at')->nullable()->after('otp');
             $table->string('otp_refresh_token',255)->nullable()->after('otp_at');
             $table->string('lang',20)->nullable()->after('otp_refresh_token');
             $table->integer('status')->nullable()->default(1)->after('lang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_id');
            $table->dropColumn('country_id');
            $table->dropColumn('country_code');
            $table->dropColumn('mobile');
            $table->dropColumn('otp');
            $table->dropColumn('otp_at');
            $table->dropColumn('otp_refresh_token');
            $table->dropColumn('lang');
            $table->dropColumn('status');
        });
    }
};
