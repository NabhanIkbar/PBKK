<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookAuthor extends Model
{
   
    use HasUlids;
    
    protected $fillable =[
    'book_id',
    'author_id'
    ];

    protected $table = 'book_authors';

    protected function casts(): array
    {
        return [
            'nama_barang' => 'string',
            'author_id' => 'string'
        ];
    }


    // Relasi ke book
     public function book():BelongsTo{
        return $this->belongsTo(Book::class, 'user_id');
    }

    public function author():BelongsTo{
        return $this->belongsTo(Author::class, 'author_id');
    }
}