<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $color
 * @property string $status
 * @property string $integrality
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $down_at
 */

class Apple extends ActiveRecord
{
    const COLOR_RED = 'red';
    const COLOR_GREEN = 'green';
    const COLOR_YELLOW = 'yellow';
    const STATUS_ON_TREE = 'onTree';
    const STATUS_ON_FLOOR = 'onFloor';
    const STATUS_ON_ROTTED = 'rotted';

    CONST STATUS_NAMES = [
        self::STATUS_ON_TREE => 'На дереве',
        self::STATUS_ON_FLOOR => 'На полу',
        self::STATUS_ON_ROTTED => 'Сгнило',
    ];
    public static function tableName(): string
    {
        return 'apple';
    }
}
