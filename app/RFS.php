<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RFS extends Model
{
    protected $table = 'request_for_shipment';
    public $timestamps = true;
    public function sites()
    {
        return $this->hasOne("App\Site","id","site_id");
    }
}
