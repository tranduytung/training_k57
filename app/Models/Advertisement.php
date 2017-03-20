<?php

namespace App\Models;

use App\Contracts\DBTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Advertisement
 *
 * @package App\Models
 * @property int $id
 * @property string $logo
 * @property string $company_name
 * @property string $product_name
 * @property string $content
 * @property string $image
 * @property array  $image_size ["width" => 250, "height" => 250]
 * @property string $url
 * @property int $monthly_budget
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $image_width
 * @property int $image_height
 */
class Advertisement extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = DBTable::ADVERTISEMENT;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'logo',
        'company_name',
        'product_name',
        'content',
        'image',
        'image_size',
        'monthly_budget',
        'url',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'image_size' => 'json',
        'monthly_budget' => 'int',
    ];

    /**
     * Get Width Image
     *
     * @return int
     */
    public function getImageWidthAttribute()
    {
        $width = $this->image_size['width'] ?? null;

        return is_null($width) ? null : intval($width);
    }

    /**
     * Get Height Image
     *
     * @return int
     */
    public function getImageHeightAttribute()
    {
        $height = $this->image_size['height'] ?? null;

        return is_null($height) ? null : intval($height);
    }
}
