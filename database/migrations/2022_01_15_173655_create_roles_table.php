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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->integer('usertypeId');
            $table->integer('view_users')->default(0);
            $table->integer('create_users')->default(0);
            $table->integer('edit_users')->default(0);
            $table->integer('delete_users')->default(0);
            $table->integer('view_events')->default(0);
            $table->integer('edit_events')->default(0);
            $table->integer('create_events')->default(0);
            $table->integer('delete_events')->default(0);
            $table->integer('view_endusers')->default(0);
            $table->integer('edit_endusers')->default(0);
            $table->integer('create_endusers')->default(0);
            $table->integer('delete_endusers')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('roles');
    }
}
