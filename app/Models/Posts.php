<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    // ストロングパラメータのようなもの？
    // メッセージ投稿を許可する
    protected $fillable = [
        'message',
    ];
}
