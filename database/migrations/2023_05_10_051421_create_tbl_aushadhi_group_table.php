<?php

use App\Traits\Column_migration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use Column_migration;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_aushadhi_group', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->string('aushadhi_name', 250);
            $table->int('aus_id');
            $table->string('image', 250);
            $table->text('type_of_formulation');
            $table->text('reference');
            $table->text('ingredients');
            $table->text('method_of_preparation');
            $table->text('indications');
            $table->text('dose_with_duration');
            $table->text('anupana');
            $table->text('research_updates');
            $table->text('cross_references');  
            $table->string('audio_file', 250);
            $this->Column_migration($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_aushadhi_group');
    }
};
