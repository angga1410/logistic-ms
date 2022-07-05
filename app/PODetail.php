<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PODetail extends Model
{
    protected $table = 'po_details';
    public function products()
    {
        return $this->hasOne("App\Product","id","product_id");
    }
}
