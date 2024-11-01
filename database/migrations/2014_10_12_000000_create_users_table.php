<?php

use App\Enums\DefaultActiveStatus;
use App\Enums\User\AutoNotification;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('code', 50);
            $table->char('username', 100)->nullable();
            $table->string('slug');
            $table->string('fullname');
            $table->char('email', 100)->nullable();
            $table->char('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->text('avatar')->nullable();
            $table->text('token_active_account')->nullable();
            $table->date('birthday')->nullable();
            $table->string('device_token')->nullable();
            $table->tinyInteger('gender');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('token_expiration')->nullable();
            $table->string('token_get_password')->nullable();
            $table->string('password')->nullable();
            $table->boolean('active')->default(DefaultActiveStatus::Active->value);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
