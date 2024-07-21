<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\Column_migration;


return new class extends Migration
{
    use Column_migration;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aushadhis', function (Blueprint $table) {
            $table->id();
            $table->uuid('aushadhi_group_id')->nullable(false);
            $this->Column_migration($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aushadhis');
    }
};
