<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('kpis', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->references('id')->on('projects');
            $table->boolean('isCompany')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('kpis', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_id');
            $table->dropColumn('isCompany');
        });
    }
};
