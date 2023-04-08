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
        Schema::create('passes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('PassNumber');
            $table->string('CarNumber');
            $table->string('FIO');
            $table->string('SenderName');
            $table->string('CheckpointNumber');
            $table->string('ProductType');
            $table->float('ProductVolume');
            $table->enum('MetricUnit',['КГ','Т']);
            $table->enum('status', ['Отсутствует', 'Прибыл', 'Ожидание']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passes');
    }
};
