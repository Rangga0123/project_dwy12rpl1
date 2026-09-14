<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Nama tabel di database kamu adalah "restocks"
    protected $table = 'restocks';

    protected $fillable = [
        'title',
        'author',
        'stock',
    ];

    public function restockRequests()
    {
        return $this->hasMany(RestockRequest::class, 'book_id');
    }
}