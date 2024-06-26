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
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();
            $table->string('complainant');
            $table->string('respondent')->nullable();
            $table->dateTime('date_of_incident');
            $table->string('location');
            $table->foreignId('official_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('statement');
            $table->boolean('is_solved')->default(0);
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
        Schema::dropIfExists('blotters');
    }
};