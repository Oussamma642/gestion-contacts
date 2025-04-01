<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('related_persons', function (Blueprint $table) {
            $table->id();
            
            // Foreign key references to contacts
            $table->foreignId('personA')->constrained('contacts')->onDelete('cascade');
            $table->foreignId('personB')->constrained('contacts')->onDelete('cascade');
            
            // Foreign key reference to type_relations
            $table->foreignId('type_relation_id')->constrained('type_relations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('related_persons');
    }
};