<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('type_relations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['friend', 'brother', 'sister', 'mother', 'father', 'cousin', 'child'])
                  ->default('friend'); // Default value
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_relations');
    }
};