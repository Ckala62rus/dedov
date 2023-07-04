<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('service')->nullable();
            $table->string('owner')->nullable();
            $table->string('hostname')->nullable();
            $table->string('object')->nullable();
            $table->string('tool')->nullable();
            $table->string('bd')->nullable();
            $table->string('restricted_point')->nullable();
            $table->string('type')->nullable();
            $table->string('day')->nullable();
            $table->string('time_start')->nullable();
            $table->string('storage_server')->nullable();
            $table->string('storage_long_time')->nullable();
            $table->string('description_storage_long_time')->nullable();
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
        Schema::dropIfExists('backups');
    }
};
