<?php
namespace backend\FormRequest;
use common\models\Apple;
use yii\web\Request;
use yii\web\ServerErrorHttpException;

class AppleRequest extends Request
{
    /**
     * @throws ServerErrorHttpException
     */
    public function validateDown(): \yii\db\ActiveRecord
    {
        $apple = Apple::find()->where(
            [
                'status' => Apple::STATUS_ON_TREE,
                'id' => $this->post('apple_id'),
            ]
        )->one();

        if (empty($apple)) {
            throw new ServerErrorHttpException('Яблоко уже лежит на полу');
        }

        return $apple;
    }

    /**
     * @throws ServerErrorHttpException
     */
    public function validateBite(): \yii\db\ActiveRecord
    {
        $percentBite = round($this->post('percent'));

        if ($percentBite <= 0 || $percentBite > 100 ) {
            throw new ServerErrorHttpException('Съесть можно не менее 1% и не более 100%');
        }

        $apple = Apple::find()->where(
            [
                'status' => Apple::STATUS_ON_FLOOR,
                'id' => $this->post('apple_id'),
            ]
        )->one();

        if (empty($apple)) {
            throw new ServerErrorHttpException('Яблоко висит на дереве или сгнило');
        }

        return $apple;
    }
}
