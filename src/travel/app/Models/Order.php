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
    protected $fillable = [
        'rid',
        'cid',
        'checkin',
        'checkout',
        'money',
        'payed',
        'payType',
        'status'
    ];

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
    public function orderConsumer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Consumer', 'cid', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function orderRoom(): BelongsTo
    {
        return $this->belongsTo('App\Models\RoomType', 'rid', 'id');
    }
}
