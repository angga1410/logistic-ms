<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forwarder extends Model
{
    protected $connection = 'mysql3';
    protected $table = "mover";
}
