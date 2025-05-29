<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
 
    use HasUlids;
    
    protected $fillable =[
    'title',
    'isbn',
    'publisher',
    'year_published',
    'stock',
    ];

    protected $table = 'books';

    protected function casts(): array
    {
        return [
            'title' => 'string',
        ];
    }

    public function loan():HasMany{
        return $this->hasMany(Loan::class,'book_id');
    }
     public function bookauthor():HasMany{
        return $this->hasMany(BookAuthor::class,'book_id');
    }   
}