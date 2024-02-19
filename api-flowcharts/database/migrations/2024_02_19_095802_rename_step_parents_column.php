<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('step_parents', function(Blueprint $table) {
            $table->renameColumn('parent_step_id', 'step_parent_id');
        });
    }


    public function down()
    {
        Schema::table('step_parents', function(Blueprint $table) {
            $table->renameColumn('step_parent_id', 'parent_step_id');
        });
    }

};
