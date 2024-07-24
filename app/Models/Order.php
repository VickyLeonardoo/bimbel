<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    
    public function course(){
        return $this->belongsToMany(Course::class, 'order_items')->withPivot('price');
    }

    public function child(){
        return $this->belongsToMany(Child::class, 'order_items');
    }

    
    
}
