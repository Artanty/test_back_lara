<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get orders for the product.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    
}
