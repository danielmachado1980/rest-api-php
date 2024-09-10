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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('document');
            $table->string('phone_number')->nullable();
            $table->char('profile', 1)->default('R');
            $table->timestamps();
        });

        // Inserir dados iniciais na tabela
        DB::table('users')->insert([
            [
                'name' => 'next adm',
                'email' => 'admin@example.com',
                'password' => bcrypt('next'),
                'created_at' => now(),
                'updated_at' => now(),
                'document' => '6546546546/0001-1',
                'phone_number' => '(14)99465-4645',
                'profile' => 'A'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
