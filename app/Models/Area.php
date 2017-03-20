<?php

namespace App\Models;

use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Area
 * @package App\Models
 * @property int $id
 * @property string $name
 */
class Area extends Model
{
    /**
     * @var string
     */
    protected $table = DBTable::AREA;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var bool
     */
    public $timestamps = false;
}
