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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->enum('education_level',[
                'High school',
                'GED Program',
                'Vocational/trade school',
                'Associate degree program',
                'Bachelors degree program',
                'Masters degree program',
                'Doctorate program',
                'Certification program',
                'Other professional or training school'
            ])->nullable();
            $table->enum('education_status',[
                'Graduated',
                'Currently enrolled',
                'Neither'
            ]);
            $table->string('education_field');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
