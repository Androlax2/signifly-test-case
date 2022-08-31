<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project_team_member', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(\App\Models\Project::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(\App\Models\TeamMember::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_team_member');
    }
};
