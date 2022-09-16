<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;


class Preview extends Model
{
    use HasFactory;
    protected    
    $fillable = ['book_id', 'preview', 'page'];

    public static function getPreview($book_id){
        return Preview::where('book_id', '=', $book_id)->get();
    }

}
