<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'e_gedung';
    protected $primaryKey = 'gdid';
    public $incrementing = false;
    public $timestamps = false;
}
