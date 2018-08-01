<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */

namespace powerkernel\yiiauth\components;

use powerkernel\yiiauth\models\AuthSource;
use powerkernel\yiiuser\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class AuthHandler
 * @package powerkernel\yiiauth\components
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * AuthHandler constructor.
     * @param $client
     * @throws Exception
     */
    public function __construct($client)
    {
        $this->client = Yii::$app->authClientCollection->getClient($client);
        // Get the access_token and save them to the session.
        if (($code = Yii::$app->request->get('code')) !== null) {
            $token = $this->client->fetchAccessToken($code);
            if (empty($token)) {
                throw new Exception('Invalid access token.');
            }
        }
    }

    /**
     * handle info
     * @return array
     */
    public function handle()
    {
        /* get user info */
        $attributes = $this->client->getUserAttributes();
        $id = ArrayHelper::getValue($attributes, 'id');
        $email = ArrayHelper::getValue($attributes, 'email');
        $name = ArrayHelper::getValue($attributes, 'name');

        /* @var AuthSource $auth */
        $authSource = AuthSource::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $id,
        ])->one();

        $user=null;
        /* already auth before */
        if ($authSource) {
            if (!$user=User::find()->where(['_id' => $authSource->user_id])->one()) {
                return [
                    'success' => false,
                    'data' => [
                        'error' => 'Cannot find account.'
                    ]
                ];
            }

        }
        else {
            /* 1st time auth */
            $authSource = new AuthSource();
            /* find or create account */
            if (!$user = User::find()->where(['email' => $email])->one()) {
                $user = new User([
                    'name' => $name,
                    'email' => $email,
                ]);
                if (!$user->save()) {
                    return [
                        'success' => false,
                        'data' => [
                            'error' => 'Cannot create account.'
                        ]
                    ];
                }
            }

            /* save auth source */
            $authSource->user_id = (string)$user->_id;
            $authSource->source = $this->client->getId();
            $authSource->source_id = (string)$id;
            $authSource->save();
        }

        // result
        return [
            'success' => true,
            'data' => [
                'access_token' => $user->access_token
            ]
        ];

    }

}