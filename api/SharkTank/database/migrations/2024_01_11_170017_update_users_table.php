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
            $table->string('surname')->after('name');
            $table->string('phone')->after('email');
            $table->string('image')->default('placeholder.png')->
                after('password');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn('surname');
        $table->dropColumn('phone');
        $table->dropColumn('image');
        
    }
};
