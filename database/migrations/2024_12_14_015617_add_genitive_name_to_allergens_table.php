<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('allergens', function (Blueprint $table) {
            $table->string('genitive_name')->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('allergens', function (Blueprint $table) {
            $table->dropColumn('genitive_name');
        });
    }
};
