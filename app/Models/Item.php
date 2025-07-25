<?php

namespace App\Models;
use App\Models\User;
use App\Models\Location;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'origin', 'location_id', 'category_id', 'type', 'status', 'quantity', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function returnings()
    {
        return $this->hasOne(Returning::class);
    }
}
