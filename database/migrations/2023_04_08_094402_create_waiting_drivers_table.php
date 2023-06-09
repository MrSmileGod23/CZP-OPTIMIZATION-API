<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waiting_drivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('PassNumber');
            $table->string('CarNumber');
            $table->string('FIO');
            $table->string('SenderName');
            $table->string('CheckpointNumber');
            $table->string('ProductType');
            $table->float('ProductVolume');
            $table->enum('MetricUnit', ['КГ', 'Т']);
            $table->enum('status', ['Отсутствует', 'Прибыл', 'Ожидание']);
            $table->integer('queue')->nullable();
            $table->enum('point', ['Северный', 'Южный'])->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiting_drivers');
    }
};
