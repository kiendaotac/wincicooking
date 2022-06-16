<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLikeRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_like_recipes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->on((new \App\Models\User())->getTable());
            $table->foreignId('recipe_id')->constrained()->on((new \App\Models\Recipe())->getTable());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_like_recipes');
    }
}
