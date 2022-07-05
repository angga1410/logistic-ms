<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    protected $table = 'delivery_order';
    public $timestamps = true;
    public function sites()
    {
        return $this->hasOne("App\Site","id","site_id");
    }
    public function rfs()
    {
        return $this->hasOne("App\RFS","id","rfs_id");
    }
    public function mover()
    {
        return $this->hasOne("App\Forwarder","id","mover_id");
    }
    public function details(){
    	return $this->hasMany('App\DODetails','do_id','id');
    }
}
