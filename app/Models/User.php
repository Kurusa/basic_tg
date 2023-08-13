<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'user_name',
        'first_name',
        'last_name',
        'chat_id',
        'status',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
