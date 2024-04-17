<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class FoodList extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'foodlist';
    protected $fillable = [
        'FoodListId',
        'CategoryId',
        'FoodName',
        'Price',
        'qty',
        'UploadImage',
        'Description',
        'UserId',
        'Status',
        'IsNew',
        'IsNoiBat',
        'QuantitySupplied',
        'Qtycontrolled',
        'QtySuppliedcontrolled',
        // Add other fields here as needed
    ];

}
