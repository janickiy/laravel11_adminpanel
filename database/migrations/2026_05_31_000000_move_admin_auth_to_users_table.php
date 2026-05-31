<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'email') && !Schema::hasColumn('users', 'login')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->renameColumn('email', 'login');
                });
            }

            if (Schema::hasColumn('users', 'email')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('email');
                });
            }

            if (!Schema::hasColumn('users', 'role')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('role')->default('admin');
                });
            }

            if (Schema::hasColumn('users', 'email_verified_at')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('email_verified_at');
                });
            }
        }

        if (Schema::hasTable('password_reset_tokens') && Schema::hasColumn('password_reset_tokens', 'email') && !Schema::hasColumn('password_reset_tokens', 'login')) {
            Schema::table('password_reset_tokens', function (Blueprint $table) {
                $table->renameColumn('email', 'login');
            });
        }

        if (Schema::hasTable('admin')) {
            if (Schema::hasTable('users') && Schema::hasColumn('users', 'login')) {
                foreach (DB::table('admin')->orderBy('id')->get() as $admin) {
                    DB::table('users')->updateOrInsert(
                        ['login' => $admin->login],
                        [
                            'name' => $admin->name ?: $admin->login,
                            'role' => $admin->role,
                            'password' => $admin->password,
                            'remember_token' => $admin->remember_token,
                            'created_at' => $admin->created_at,
                            'updated_at' => $admin->updated_at,
                        ],
                    );
                }
            }

            Schema::dropIfExists('admin');
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->id();
                $table->string('login')->unique();
                $table->string('password');
                $table->string('name')->nullable();
                $table->string('role');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }
};
