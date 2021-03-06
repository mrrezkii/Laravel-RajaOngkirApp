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
        Schema::create('cost_logs', function (Blueprint $table) {
            $table->uuid('cost_log_id')->unique()->primary();
            $table->foreignUuid('cost_id');
            $table->string('courier');
            $table->string('service');
            $table->string('description');
            $table->string('price');
            $table->string('etd_day');
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
        Schema::dropIfExists('cost_logs');
    }
};
