<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Authenticatable
{
    use HasFactory;

    protected $table      = "users";
    protected $primaryKey = "id";
    public $incrementing  = true;
    public $timestamps    = true;

    protected $fillable = [
        "username",
        "password",
        "saldo",
        "role"
    ];
}
