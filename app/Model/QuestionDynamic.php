<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property int $views 
 * @property int $comments 
 * @property int $replys 
 * @property int $supports 
 * @property int $create_time 
 * @property int $update_time 
 */
class QuestionDynamic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_dynamic';
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
    protected $casts = ['id' => 'integer', 'views' => 'integer', 'comments' => 'integer', 'replys' => 'integer', 'supports' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer'];
}