<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('raports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('score_id');
            $table->string('principal_signature');
            $table->string('signature');
            $table->enum('status', [
                'already_printed',
                'not_printed_yet',
                'confirmed',
                'not_confirmed',
            ]);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raports');
    }
};
