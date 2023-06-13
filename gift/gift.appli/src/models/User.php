<?php

namespace gift\app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function existFromDatabase(string $email, string $password): bool
    {
        $user = User::where('email', $email)->where('password', $password)->first();
        return $user != null;
    }

    public static function existFromSession(): bool
    {
        return isset($_SESSION['user']);
    }
}