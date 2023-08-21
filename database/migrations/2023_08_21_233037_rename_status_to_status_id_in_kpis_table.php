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
        Schema::table('kpis', function (Blueprint $table) {
            if (Schema::hasColumn('kpis', 'status')) {
                $table->dropColumn('status');
            }
            $table->foreignId('status_id')->after('frequency')->nullable()->references('id')->on('statuses')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kpis', function (Blueprint $table) {
            if (!Schema::hasColumn('kpis', 'status')) {
                $table->string('status')->nullable();
            }
            $table->dropConstrainedForeignId('status_id');
        });
    }
};
