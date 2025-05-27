<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assign_locks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')
                ->comment('hold roles table primary id');
            $table->unsignedBigInteger('permission_id')
                ->comment('hold permissions table primary id');
            $table->tinyInteger('status')
                ->default(1)
                ->comment('1 for active , 2 for deactive');
            $table->timestamps();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions');

            $table->unique([
                'role_id',
                'permission_id',
                'status'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_locks');
    }
};
// "BugLock/rolepermissionmodule": "@dev"