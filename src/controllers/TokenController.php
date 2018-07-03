<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */


namespace powerkernel\yiiauth\controllers;

use powerkernel\yiiauth\forms\AuthGetTokenForm;
use powerkernel\yiiauth\models\Auth;


/**
 * Class TokenController
 */
class TokenController extends \powerkernel\yiicommon\controllers\RestController
{
    /**
     * @inheritdoc
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            '__class' => \yii\filters\VerbFilter::class,
            'actions' => [
                'get' => ['POST'],
            ],
        ];
        return $behaviors;
    }


    /**
     * Get access token
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\UnsupportedMediaTypeHttpException
     */
    public function actionGet()
    {
        $form = new AuthGetTokenForm();
        $form->load(\Yii::$app->getRequest()->getParsedBody(), '');
        if ($form->validate()) {
            return [
                'success' => true,
                'data' => [
                    'token' => $form->token
                ]
            ];
        }

        return [
            'success' => false,
            'data' => [
                'errors' => $form->errors
            ]
        ];
    }
}
