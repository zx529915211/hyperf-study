<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;

abstract class Model extends BaseModel
{

    public $defaultCasts = ['id' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime'];


    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);
        parent::mergeCasts($this->defaultCasts);
    }

    public const CREATED_AT = 'create_time';
    public const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
}
