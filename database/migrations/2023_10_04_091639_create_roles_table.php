<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id('role_id'); // Unsigned auto-incremental primary key
            $table->string('name')->nullable(); // Nullable name column
            $table->text('privileges')->nullable(); // Nullable privileges column (use text for storing JSON data)
            $table->mediumInteger('created_by')->unsigned()->nullable(); // Unsigned medium integer for created_by
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
