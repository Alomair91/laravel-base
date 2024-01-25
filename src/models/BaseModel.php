<?php

namespace omairtech\laravel\base\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class BaseModel extends Model
{
    use SoftDeletes, Notifiable, HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_by',

        'updated_at',
        'deleted_at',

        'laravel_through_key'
    ];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['created_at','updated_at','deleted_at'];



    private function localTimezone($value = null)
    {
        return $value ? Carbon::parse($value)->setTimezone(env("APP_TIMEZONE","UTC"))->toDateTimeString() : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->localTimezone($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->localTimezone($value);
    }

    public function getDeletedAtAttribute($value)
    {
        return $this->localTimezone($value);
    }
}
