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
        Schema::table('kpi_result_histories', function (Blueprint $table) {
            $table->string('title');
            $table->foreignId('creator_id')->nullable()->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('kpi_result_histories', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropConstrainedForeignId('creator_id');
        });
    }
};
