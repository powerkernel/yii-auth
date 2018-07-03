<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */

namespace powerkernel\yiiauth\v1\controllers;

use powerkernel\yiicommon\controllers\RestController;

/**
 * Class DefaultController
 * @package powerkernel\yiiauth\v1\controllers
 */
class DefaultController extends RestController
{
    /**
     * index
     * @return array
     */
    public function actionIndex()
    {
        return [
            'success' => true,
            'module' => 'Auth API',
            'version' => '1.0.0'
        ];
    }
}