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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->nullable(false);
            $table->string('full_name',250);
            $table->string('email',250)->unique();
            $table->string('password',250);
            $table->integer('otp',11)->nullable();
            $table->string('phone_number',15)->unique();
            $table->timestamp('otp_created_at');
            $this->Column_migration($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
