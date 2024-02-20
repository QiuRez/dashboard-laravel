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
        Schema::create('AdminLog', function (Blueprint $table) {
            $table->id('LogID');
            $table->foreignId('AdminID')->constrained('Users', 'UserID');
            $table->text('Action');
            $table->foreignId('TargetUserID')->nullable()->constrained('Users', 'UserID');
            $table->foreignId('TargetAdID')->nullable()->constrained('Adverisements', 'AdID')->onDelete('cascade');
            $table->dateTime('Time')->default(date("Y-m-d H:i:s"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('AdminLog');
    }
};
