<?php

use App\Enums\StatusEnum;
use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('causer_type');
            $table->bigInteger('causer_id');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('content');
            $table->tinyInteger('order')->default(0);
            $table->string('status')->default(StatusEnum::ACTIVE);
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
        Schema::dropIfExists('sections');
    }
}
