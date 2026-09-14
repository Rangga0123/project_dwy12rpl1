<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'jumlah',
        'alasan',
        'status',
        'catatan_admin',
    ];

    /**
     * Pengajuan milik user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Buku yang diajukan
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}