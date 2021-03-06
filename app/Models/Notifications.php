<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = "notifications";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "title",
        "body",
        "sender",
        "receive",
        "action",
        "content",
        "datetime"
    ];
}
