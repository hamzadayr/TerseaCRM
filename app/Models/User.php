<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'remember_token'
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function employee() {
        return $this->hasOne(Employee::class);
    }

    public function invitations() {
        return $this->hasMany(Invitation::class);
    }

}