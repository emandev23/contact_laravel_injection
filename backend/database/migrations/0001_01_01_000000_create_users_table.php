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
            $table->id(); // AUTO_INCREMENT column 'id'
            $table->string('name', 255); // Name length of 255 characters
            $table->string('email', 191)->unique(); // Email length of 191 characters (to avoid MySQL index length issue)
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255); // Password length of 255 characters
            $table->rememberToken(); // Length 100 by default
            $table->timestamps(); // Created_at and updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 191)->primary(); // Email length of 191 characters for the primary key
            $table->string('token', 255); // Token length of 255 characters
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 191)->primary(); // Reduced length to 191 characters to fit within MySQL index size
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};