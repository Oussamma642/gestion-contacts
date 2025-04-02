<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('related_persons', function (Blueprint $table) {

            $table->id();
            $table->foreignId('personA')->constrained('contacts')->onDelete('cascade');
            $table->foreignId('personB')->constrained('contacts')->onDelete('cascade');

            $table->enum('type', [
                // Symmetric relationships
                'friend', 'sibling', 'cousin', 'spouse',
                // Directional relationships
                'parent_of', 'child_of', 'mentor_of', 'mentee_of',
            ])->default('friend');

            $table->unique(['personA', 'personB', 'type']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('related_persons');
    }
};