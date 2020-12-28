<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PizzaProduct
 * @package App\Models
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $order
 * @property string $picture
 * @property string $price
 * @property integer $disabled
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 *
 */
class PizzaProduct extends Model
{
    use HasFactory;
    const DISABLED_INSTOCK = 0;
    const DISABLED_OUTOFSTOCK = 1;
    const DISABLED_HIDDEN = 2;

    protected $fillable = [
        'title', 'description', 'order', 'price', 'disabled',
    ];
    protected $attributes = [
        'order' => 1000,
        'disabled' => PizzaProduct::DISABLED_INSTOCK,
    ];
    protected $hidden = array('created_at', 'updated_at');
}
