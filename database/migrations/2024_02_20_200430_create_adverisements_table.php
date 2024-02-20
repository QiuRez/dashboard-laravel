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
        Schema::create('Adverisements', function (Blueprint $table) {
            $table->id('AdID');
            $table->foreignId('UserID')->constrained('Users', 'UserID');
            $table->foreignId('CategoryID')->constrained('Categories', 'CategoryID');
            $table->string('Title');
            $table->string('Description');
            $table->string('AdPhoto')->nullable();
            $table->string('Status');
            $table->dateTime('Created_at')->default(date("Y-m-d H:i:s"));
            $table->dateTime('Updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Adverisements');
    }
};
