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
        Schema::create('job_offer_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->double('salary',8,2);
            $table->integer('required_experience')->nullable()->default(null);
            $table->enum('industry', ['Tech', 'Consulting', 'Advertising']);
            $table->foreignId('country_id');
            $table->foreignId('city_id');
            $table->enum('flexibility',['On site', 'Hybrid', 'Remote']);
            $table->enum('requestedContract', ['Full-time', 'Part-time', 'Contract', 'Freelance']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offer_posts');
    }
};