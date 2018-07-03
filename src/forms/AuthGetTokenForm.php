<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */

namespace powerkernel\yiiauth\forms;

use powerkernel\yiiauth\models\Auth;
use yii\base\Model;

/**
 * Class AuthGetTokenForm
 * @package powerkernel\yiiauth\forms
 */
class AuthGetTokenForm extends Model
{
    public $aid;
    public $code;
    public $token;

    /**
     * @inheritdoc
     * @return array
     */
    public function rules()
    {
        return [
            [['aid', 'code'], 'required'],
            [['aid', 'code'], 'trim'],
            [['code'], 'checkAuth'],
        ];
    }

    /**
     * check auth
     * @param $attribute
     * @param $params
     */
    public function checkAuth($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $auth = Auth::verify($this->aid, $this->code);
            if ($auth) {
                $token = $auth->getAccessToken();
                if ($token !== false) {
                    $auth->status = Auth::STATUS_USED;
                    $this->token = $token;
                } else {
                    $this->addError($attribute, \Yii::t('auth', 'This Auth ID cannot be used to get access token.'));
                }
            } else {
                $this->addError($attribute, \Yii::t('auth', 'We cannot process the request.'));
            }
        }
        unset($params, $validator);
    }
}