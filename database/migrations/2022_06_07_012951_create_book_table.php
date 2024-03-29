<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('isbn')->unique();
            $table->string('slug');
            $table->longText('summary');
            $table->longText('description');
            $table->integer('stock')->default(1);
            $table->text('image');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->float('price');
            $table->float('discount');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('writer_id')->nullable();
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('SET NULL');
            $table->foreign('writer_id')->references('id')->on('writer')->onDelete('SET NULL');;
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('SET NULL');
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
        Schema::dropIfExists('books');
    }
}
