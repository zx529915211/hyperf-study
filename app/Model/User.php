<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property string $email 
 * @property string $password 
 * @property string $pic 
 * @property string $nickname 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'pic', 'nickname'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}