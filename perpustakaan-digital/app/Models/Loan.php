<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    
    use HasUlids;
    
    protected $fillable =[
    'user_id',
    'book_id'
    ];

    protected $table = 'loans';

    protected function casts(): array
    {
        return [
            'user_id' => 'string',
            'book_id' => 'string'
        ];
    }


    // Relasi ke user
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book():BelongsTo{
        return $this->belongsTo(Book::class, 'book_id');
    }
}