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
    public function up()
    {
        Schema::create('kpi_result_histories', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->enum('status', ['previous', 'current'])->default('current');
            $table->foreignId('kpi_id')->references('id')->on('kpis')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_result_histories');
    }
};
