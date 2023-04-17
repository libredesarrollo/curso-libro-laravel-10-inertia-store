<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
      Schema::create('contact_generals', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 255);
            $table->text('message');
            $table->enum('type', ['company', 'person']);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('contact_generals');
    }
};