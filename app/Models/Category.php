<?php

namespace App\Models;

use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 * @property int $id
 * @property string $name
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = DBTable::CATEGORY;

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
