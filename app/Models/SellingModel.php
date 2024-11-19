<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingModel extends Model
{
    use HasFactory;
    protected $table ="selling";
    protected $fillable=[
'name',
'phone',
'email',
'amount',
'profit',
    ];
}
