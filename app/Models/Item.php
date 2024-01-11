<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class Item extends Model implements Buyable
{
    use HasFactory;

    /**
     * Nome da tabela associada a essa modal
     *
     * @var string
     */
    protected $table = "item";

    /**
     * Primary key dessa tabela
     *
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * O formato de data usado na tabela
     *
     * @var string
     */
    protected $dateFormat = "Y-m-d H:i:s";

    /**
     * Tabelas em que as timestamps sao guardadas
     */
    const CREATED_AT = "registration_date";
    const UPDATED_AT = "update_date";


    /**
     * Os atributos que poderão ser inseridos pela
     * UI da aplicação
     *
     * @var array
     */
    protected $fillable = [
        "name", "price", 'item_type_id'
    ];

    public function activity()
    {
        return $this->hasOne(Activity::class);
    }
    public function order() {
        return $this->hasMany(Order::class);
    }

    public function userShoppingCart() {
        return $this->hasManyThrough(User::class, ItemShoppingCart::class);
    }

    public function userWishlist() {
        return $this->hasManyThrough(User::class, ItemWishlist::class);
    }

    public function userReservationList() {
        return $this->hasManyThrough(User::class, ItemReservationList::class);
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getBuyableWeight($options = null)
    {
        return 0;
    }
}
