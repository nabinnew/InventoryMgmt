<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelldtlModel extends Model
{
    use HasFactory;
protected $table ="delldtl";
 
protected $fillable = [
    'name',
    'phone',
    'cat',
    'pname',
    'qty',
    'price',

    'total',
];
}
