<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */


namespace powerkernel\yiiauth\controllers;



use powerkernel\yiiauth\components\AuthHandler;

/**
 * Class ClientController
 */
class ClientController extends \powerkernel\yiicommon\controllers\RestController
{
    /**
     * @inheritdoc
     * @return array
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'powerkernel\yiiauth\actions\AuthAction',
            ],
        ];
    }

    /**
     * Auth Success
     * @param string $client
     * @return array
     * @throws \yii\base\Exception
     */
    public function actionSuccess($client)
    {
        return (new AuthHandler($client))->handle();
    }
}
