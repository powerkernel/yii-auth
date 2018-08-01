<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2018 Power Kernel
 */

namespace powerkernel\yiiauth\models;

use powerkernel\yiicommon\behaviors\UTCDateTimeBehavior;


/**
 * Class AuthSource
 * @package powerkernel\yiiauth\models
 *
 * @property mixed $_id
 * @property string $user_id
 * @property string $source
 * @property string $source_id
 * @property \MongoDB\BSON\UTCDateTime $created_at
 * @property \MongoDB\BSON\UTCDateTime $updated_at
 */
class AuthSource extends \yii\mongodb\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'auth_source';
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            '_id',
            'user_id',
            'source',
            'source_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * get id
     * @return \MongoDB\BSON\ObjectID|string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            UTCDateTimeBehavior::class,
        ];
    }

    /**
     * @return int timestamp
     */
    public function getUpdatedAt()
    {
        return $this->updated_at->toDateTime()->format('U');
    }

    /**
     * @return int timestamp
     */
    public function getCreatedAt()
    {
        return $this->created_at->toDateTime()->format('U');
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        $default = [
            [['user_id', 'source', 'source_id'], 'required'],
            [['user_id', 'source', 'source_id'], 'string'],
            [['created_at', 'updated_at'], 'yii\mongodb\validators\MongoDateValidator'],
        ];

        return $default;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => \Yii::t('auth', 'User ID'),
            'source' => \Yii::t('auth', 'Source'),
            'source_id' => \Yii::t('auth', 'Source ID'),
            'created_at' => \Yii::t('auth', 'Created At'),
            'updated_at' => \Yii::t('auth', 'Updated At'),
        ];
    }

}