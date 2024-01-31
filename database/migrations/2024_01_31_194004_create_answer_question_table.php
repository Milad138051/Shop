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
        Schema::create('answer_question', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->foreignId('parent_id')->nullable()->constrained('answer_question');
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('seen')->default(0)->comment('0 => unseen, 1 => seen');
            $table->tinyInteger('approved')->default(0)->comment('0 => not approved, 1 => approved');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_question');
    }
};
