<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = ['address','phone','birthdate'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function entreprise() {
        return $this->belongsTo(Entreprise::class);
    }

}