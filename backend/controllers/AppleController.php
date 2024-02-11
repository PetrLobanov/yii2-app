<?php

namespace backend\controllers;

use backend\FormRequest\AppleRequest;
use backend\Service\Apple;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

class AppleController extends Controller
{
    public function actionIndex(): string
    {
        $apples = \common\models\Apple::find()
            ->where('integrality > 0')
            ->asArray()
            ->all();

        return $this->render('apple', [
            'apples' => $apples,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function actionGenerate(): Response
    {
        Apple::generateApples();
        return $this->redirect(Url::toRoute('apple/index'));
    }

    /**
     * @throws ServerErrorHttpException
     */
    public function actionDown(AppleRequest $appleRequest): Response
    {
        $apple = $appleRequest->validateDown();

        (new Apple($apple))->down();

        return $this->redirect(Url::toRoute('apple/index'));
    }

    /**
     * @throws ServerErrorHttpException
     */
    public function actionBite(AppleRequest $appleRequest): Response
    {
        $apple = $appleRequest->validateBite();

        (new Apple($apple))->bite(round($appleRequest->post('percent')));

        return $this->redirect(Url::toRoute('apple/index'));
    }
}
