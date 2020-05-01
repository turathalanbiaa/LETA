<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("admin_role", function (Blueprint $table) {
            $table->integerIncrements("id");
            $table->unsignedInteger("admin_id");
            $table->unsignedInteger("role_id");
            $table->date("created_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("admin_role");
    }
}
