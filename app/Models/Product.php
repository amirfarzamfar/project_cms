<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['title','price','inventory','description','user_id'];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('count');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
