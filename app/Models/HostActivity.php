<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostActivity extends Model
{
    use HasFactory;

    /**
     * Nome da tabela associada a essa modal
     *
     * @var string
     */
    protected $table = "host_activity";

    /**
     * Primary key dessa tabela
     *
     * @var array
     */
    protected $primaryKey = ["activity_item_id", "host_id"];

    /**
     * Define que as primary keys não serão autoincrementadas
     *
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

    /**
     * Os atributos que poderão ser inseridos pela
     * UI da aplicação
     *
     * @var array
     */
    protected $fillable = [
        "host_id", "activity_id"
    ];
}
