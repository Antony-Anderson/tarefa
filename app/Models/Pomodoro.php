<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pomodoro extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pomodoro';

    protected $fillable = [
        'descricao',
        'tempo',
        'user_id'
    ];
    protected static function booted(): void{
        static::addGlobalScope(new UserScope);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
}
