<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DODetails extends Model
{
    protected $table = 'do_details';
    public $timestamps = true;
    public function products()
    {
        return $this->hasOne("App\Product","ProdID","product_id");
    }

    public function do(){
    	return $this->belongsTo('App\DeliveryOrder');
    }
}
