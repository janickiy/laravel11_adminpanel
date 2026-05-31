<?php

namespace App\Models;

use App\Http\Traits\StaticTableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, StaticTableName;

    public const string ROLE_ADMIN = 'admin';
    public const string ROLE_MODERATOR = 'moderator';
    public const string ROLE_EDITOR = 'editor';

    public static array $role_name = [
        self::ROLE_ADMIN => 'Админ',
        self::ROLE_MODERATOR => 'Модератор',
        self::ROLE_EDITOR => 'Редактор',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function notes()
    {
        return $this->hasMany(Notes::class);
    }
}
