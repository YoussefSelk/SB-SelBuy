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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->string('ville')->nullable();
            $table->text('description');
            $table->decimal('price', 10, 2); // Maximum of 9999999.99
            $table->boolean('is_active')->default(true); // To indicate if the announcement is active or not
            $table->dateTime('expires_at')->nullable(); // To set an expiration date for the announcement
            $table->integer('views')->default(0); // To count the number of views
            $table->integer('likes')->default(0); // To count the number of likes
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
