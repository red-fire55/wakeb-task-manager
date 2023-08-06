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
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->double('measure', 8, 2)->default(0);
            $table->double('sub_weight', 8, 2)->default(0);
            $table->foreignId('owner_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->text('notes')->nullable();
            $table->string('status')->nullable();
            $table->string('target')->nullable();
            $table->foreignId('kpi_category_id')->references('id')->on('kpi_categories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('frequency')->nullable();
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
        Schema::dropIfExists('kpis');
    }
};
