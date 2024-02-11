<?php
namespace backend\Service;

use \common\models\Apple as AppleModel;
use yii\db\ActiveRecord;

class Apple
{
    public function __construct(protected ActiveRecord $apple) {}

    /**
     * @throws \Throwable
     */
    public static function generateApples(): void
    {
        $colors = [AppleModel::COLOR_GREEN, AppleModel::COLOR_YELLOW, AppleModel::COLOR_RED];
        $statuses = [AppleModel::STATUS_ON_TREE, AppleModel::STATUS_ON_FLOOR, AppleModel::STATUS_ON_ROTTED];

        for ($i = 1; $i < rand(5,15); $i++) {
            $model = new AppleModel();
            $model->color = $colors[rand(0, count($colors) - 1)];
            $model->status = $statuses[rand(0, count($colors) - 1)];
            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
            $model->save();
        }
    }

    public function down(): void
    {
        $this->apple->status = AppleModel::STATUS_ON_FLOOR;
        $this->apple->down_at = date("Y-m-d H:i:s");
        $this->apple->save();
    }

    public function bite(int $percent): void
    {
        $this->apple->integrality = $this->apple->integrality - round($percent);
        $this->apple->save();
    }
}
