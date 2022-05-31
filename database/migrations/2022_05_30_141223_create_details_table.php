<?php

use App\Enums\StatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('content')->nullable();
            $table->string('type');
            $table->tinyInteger('order')->default(0);
            $table->string('status')->default(StatusEnum::ACTIVE);
            $table->timestamps();
        });

        Schema::create('detail_recipe', function (Blueprint $table) {
            $table->unsignedBigInteger('detail_id');
            $table->unsignedBigInteger('recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
