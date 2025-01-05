<?php

namespace App\Models;

use Database\Factories\RoomTypeFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RoomType extends Model
{
    /** @use HasFactory<RoomTypeFactory> */
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_type';

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
        'name',
        'description',
        'price',
        'count',
        'sid'
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
     * Get the store that owns the room type.
     */
    public function hotelStore(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'sid', 'id');
    }

//    /**
//     * Get room type for the order.
//     */
//    public function tags(): MorphToMany
//    {
//        return $this->morphToMany(Order::class, 'sid');
//    }
}
