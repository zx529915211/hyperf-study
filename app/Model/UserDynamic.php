<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property int $uid 
 * @property int $answers 
 * @property int $supports 
 * @property int $create_time 
 * @property int $update_time 
 */
class UserDynamic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_dynamic';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'uid' => 'integer', 'answers' => 'integer', 'supports' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer'];
}