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
        Schema::create('cars', function (Blueprint $table) {
            $table->increments("id");
            $table->string("model");
            $table->smallInteger("year");
            $table->string("type");
            $table->string("equipment");
            $table->double("price");
            $table->string("engine");
            $table->unsignedInteger("brand_id");
            $table->foreign("brand_id")->references("id")->on("brands")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
