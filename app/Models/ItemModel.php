<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;
    protected $table ="products";
    protected $fillable =['name' ,
    'pprice',
    'sellprice',
    'pqty',
    'category',
    'pphoto',
    'pdesc',
    'profit',
];

}
