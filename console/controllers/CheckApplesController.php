<?php

namespace console\controllers;

use common\models\Apple;
use yii\console\Controller;

class CheckApplesController extends Controller
{
    public function actionIndex(): void
    {
        $apples = Apple::find()
            ->where(['=', 'status', Apple::STATUS_ON_FLOOR])
            ->andWhere(['>', 'integrality', 0])
            ->andWhere(['>=', 'created_at', date('Y-m-d H:i:s', strtotime('+5 hours'))])
            ->all();

        foreach ($apples as $apple) {
            $apple->status = Apple::STATUS_ON_ROTTED;
            $apple->save();
        }
    }
}
