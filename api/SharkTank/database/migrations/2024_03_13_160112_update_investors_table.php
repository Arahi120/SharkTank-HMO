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
        Schema::table('investors', function(Blueprint $table){
            $table->string('email')->after('dob');  
            $table->string('password')->after('email');
            $table->integer('status')->default(1)->after("password");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table){
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('status');

        });
    }
};
