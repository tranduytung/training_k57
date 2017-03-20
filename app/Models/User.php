<?php

namespace App\Models;

use App\Contracts\DBTable;
use App\Notifications\UserWasRegistered as RegisteredNotification;
use App\Notifications\PasswordWillReset as PasswordResetNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $area_id
 * @property string $avatar
 * @property Carbon $birthday
 * @property string $access_token
 * @property int $gender
 * @property int $social_action_id
 * @property string $device_id
 * @property int $device_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property Area $area
 * @property Donation $donation
 * @property SocialAction $socialAction
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = DBTable::USER;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'avatar', 'birthday', 'gender', 'device_id', 'device_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'access_token',
    ];

    /**
     * @var array
     */
    protected $dates = ['birthday'];

    /**
     * The column name of the "remember me" token.
     *
     * @var string
     */
    protected $rememberTokenName = '';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function donation()
    {
        return $this->hasMany(Donation::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function socialAction()
    {
        return $this->belongsToMany(
            SocialAction::class,
            DBTable::USER_SOCIAL_ACTION,
            'user_id',
            'social_action_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    /**
     * Send notification after user sent forgot password request
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, $this));
    }

    /**
     * Send notification after user is registered
     */
    public function sendRegisteredNotification()
    {
        $this->notify(new RegisteredNotification($this));
    }

    /**
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Generate random token base email, device info
     *
     * @param string $email
     * @param string $deviceId
     * @param string|int $deveiceType
     * @return string
     */
    public static function generateAccessToken(string $email, string $deviceId, $deveiceType): string
    {
        return md5(sprintf('%s:%s:%s', $email, $deviceId, (string) $deveiceType) . Str::random(8));
    }
}
