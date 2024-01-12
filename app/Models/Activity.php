<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Activity extends Model
{
    use HasFactory;

    /**
     * Nome da tabela associada a essa modal
     *
     * @var string
     */
    protected $table = "activity";

    /**
     * Primary key dessa tabela
     *
     * @var string
     */
    protected $primaryKey = "item_id";

    /**
     * Os atributos que poderão ser inseridos pela
     * UI da aplicação
     *
     * @var array
     */
    protected $fillable = [
        "title","user_id", "description", "first_date", "last_date",
        "language_id", "duration",
        'item_id', "country_id","category_id","user_id"
    ];

    public $timestamps = false;


    public function item() {
        return $this->belongsTo(Item::class, 'item_id', 'id');
       // return $this->hasOne(Item::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

  /*  public function host() {
        return $this->hasOneThrough(Host::class, HostActivity::class);
    }
*/
    public function category() {
        return $this->hasManyThrough(Category::class, CategoryActivity::class);
    }

    public function language() {
        return $this->hasOne(Language::class);
    }
    public function country() {
        return $this->hasOne(Country::class);
    }

    public function photos()
    {
        return $this->hasMany(ActivityPhoto::class, 'activity_id', 'item_id');
    }
}
