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
        Schema::create('Comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('AuthorUserID')->constrained('Users', 'UserID');
            $table->foreignId('TargetUserID')->nullable()->constrained('Users', 'UserID');
            $table->foreignId('TargetAdID')->nullable()->constrained('Adverisements', 'AdID');
            $table->text('Description');
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
        Schema::dropIfExists('Comments');
    }
};
