<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SPKDetail extends Model
{
    protected $table = 'spk_detail';
    public $timestamps = true;
    public function do()
    {
        return $this->hasOne("App\DeliveryOrder","id","do_id");
    }
    public function site()
    {
        return $this->hasOne("App\Site","id","site_id");
    }
    public function rfs()
    {
        return $this->hasOne("App\RFS","id","rfs_id");
    }
}
