<?php

namespace App\Models;

use App\Contracts\DBTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SocialAction
 *
 * @package App\Models
 * @property int $id
 * @property string $thumbnail
 * @property string $name
 * @property string $address
 * @property int $category_id
 * @property string $url
 * @property string $activity_content
 * @property int $norm
 * @property int $donation_rate
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property Category $category
 */
class SocialAction extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = DBTable::SOCIAL_ACTION;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['thumbnail', 'name', 'address', 'url', 'activity_content', 'norm', 'donation_rate'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
