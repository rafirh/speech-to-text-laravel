<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'original_text',
        'translated_text',
        'language',
        'user_id',
    ];

    protected $table = 'histories';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
