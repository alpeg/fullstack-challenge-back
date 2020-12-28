<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property integer $id
 * @property string $name
 * @property string $tel
 * @property ?string $email
 * @property string $addr
 * @property string $total
 * @property integer|null $user_id
 * @property ?User $user
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Order extends Model
{
    use HasFactory;

    public function pizzaProducts()
    {
        return $this->belongsToMany(PizzaProduct::class)->withPivot(['amount']);
    }

    protected $fillable = [
        'name', 'tel', 'email', 'addr', 'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
