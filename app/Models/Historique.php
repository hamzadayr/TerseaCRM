<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $table = 'historique';

    protected $fillable = ['action_message'];

    public static function addToHistory($message)
    {
        $history = new Historique();
        $history->action_message = $message;
        $history->save();
    }

}
