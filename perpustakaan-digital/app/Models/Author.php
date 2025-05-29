<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    
    use HasUlids;
    
    protected $fillable =[
    'name',
    'nationality',
    'birthdate'
    ];

    protected $table = 'authors';

    protected function casts(): array
    {
        return [
            'name' => 'string',
        ];
    }


    // Relasi ke books (many-to-many)
    public function order():HasMany{
        return $this->hasMany(BookAuthor::class,'author_id');
    }
}