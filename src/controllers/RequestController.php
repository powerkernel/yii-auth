<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */


namespace powerkernel\yiiauth\controllers;

use powerkernel\yiiauth\forms\AuthRequestForm;
use powerkernel\yiiauth\models\Auth;


/**
 * Class RequestController
 */
class RequestController extends \powerkernel\yiicommon\controllers\RestController
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
                'verify' => ['POST'],
            ],
        ];
        return $behaviors;
    }

    /**
     * request verify
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\UnsupportedMediaTypeHttpException
     */
    public function actionVerify()
    {
        $form = new AuthRequestForm();
        $form->load(\Yii::$app->getRequest()->getParsedBody(), '');
        if ($form->validate()) {
            $auth = new Auth();
            $auth->identifier = $form->identifier;
            if ($auth->save()) {
                return [
                    'success' => true,
                    'data' => [
                        'aid' => (string)$auth->getId(),
                        'identifier' => $auth->identifier
                    ]
                ];
            }
        }
        return [
            'success' => false,
            'data' => [
                'errors' => $form->errors
            ]
        ];
    }

}
