<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RFSDetail extends Model
{
    protected $table = 'rfs_detail';
    public $timestamps = true;
    public function products()
    {
        return $this->hasOne("App\Product","id","product_id");
    }
}
