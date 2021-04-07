<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /**
     * Get th orders for the product.
     */
    public function orders()
    {
        return $this->hasMany('App\Orders');
    }
}
