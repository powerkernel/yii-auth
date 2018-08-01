<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */

namespace powerkernel\yiiauth\actions;

use powerkernel\yiiauth\components\OAuth2;
use yii\base\Exception;
use yii\base\NotSupportedException;

/**
 * Class AuthAction
 * @package powerkernel\yiiauth\actions
 */
class AuthAction extends \yii\authclient\AuthAction
{
    /**
     * @var string
     */
    public $clientIdGetParamName = 'client';

    /**
     * Perform authentication for the given client.
     * @param mixed $client auth client instance.
     * @return array|\yii\web\Response response instance.
     * @throws Exception
     */
    protected function auth($client)
    {
        if ($client instanceof OAuth2) {
            return $this->authOAuth2($client);
        }

        throw new NotSupportedException('Provider "' . get_class($client) . '" is not supported.');
    }

    /**
     * @inheritdoc
     * @param \yii\authclient\OAuth2 $client
     * @return array|\yii\web\Response
     * @throws Exception
     */
    protected function authOAuth2($client)
    {
        $request = \Yii::$app->getRequest();

        if (($error = $request->get('error')) !== null) {
            if ($error === 'access_denied') {
                // user denied error
                return $this->authCancel($client);
            }
            // request error
            $errorMessage = $request->get('error_description', $request->get('error_message'));
            if ($errorMessage === null) {
                $errorMessage = http_build_query($request->get());
            }
            throw new Exception('Auth error: ' . $errorMessage);
        }


        $url = $client->buildAuthUrl();

        return [
            'success' => true,
            'data' => [
                'authUrl' => $url
            ]
        ];
    }

}