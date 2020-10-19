<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvitationSkill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained();
            $table->foreignId('skill_id')->constrained();
            $table->tinyInteger('score');
            $table->unique(['invitation_id', 'skill_id']);
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
        Schema::dropIfExists('invitation_skill');
    }
}
