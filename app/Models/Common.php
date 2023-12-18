<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    use HasFactory;
    //protected $guarded = [ ];
    //protected $primaryKey = 'id';
    protected $fillable = [ '*' ];
    protected $table = 'MASTER_ICE';
    public $incrementing = false;
}
