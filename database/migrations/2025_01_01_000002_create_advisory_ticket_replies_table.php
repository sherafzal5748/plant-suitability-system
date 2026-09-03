<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advisory_ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advisory_ticket_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->boolean('is_read')->default(false); // has the USER seen this reply yet?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advisory_ticket_replies');
    }
};
