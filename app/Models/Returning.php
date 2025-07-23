<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returning extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'borrow_id', 'item_id', 'return_date', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}