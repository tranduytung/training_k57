<?php

namespace App\Models;

use App\Contracts\DBTable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class Donation
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $social_action_id
 * @property int $advertisement_id
 * @property int $calorie_value
 * @property int $donation
 * @property Carbon $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property User $user
 * @property SocialAction $socialAction
 * @property Advertisement $advertisement
 */
class Donation extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = DBTable::DONATION;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['calorie_value', 'donation', 'date'];

    /**
     * @var array
     */
    protected $dates = ['date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'advertisement_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function socialAction()
    {
        return $this->belongsTo(SocialAction::class, 'social_action_id', 'id');
    }
}
