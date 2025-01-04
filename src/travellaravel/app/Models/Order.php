<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['*'];

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function orderCustomer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer', 'cid', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function orderRoom(): BelongsTo
    {
        return $this->belongsTo('App\Models\RoomType', 'rid', 'id');
    }
}
