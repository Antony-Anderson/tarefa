<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarefa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tarefas';

    protected $fillable = [
        'nome',
        'descricao',
        'data',
        'ativo',
        'user_id'
    ];
    protected static function booted(): void{
        static::addGlobalScope(new UserScope);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
}
