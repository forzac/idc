<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "social".
 *
 * @property integer $social_id
 * @property string $social
 * @property string $url
 * @property integer $status
 *
 * @property UserSocial[] $userSocials
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social', 'url', 'status'], 'required'],
            [['status'], 'integer'],
            [['social'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'social_id' => 'Social ID',
            'social' => 'Social',
            'url' => 'Url',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSocials()
    {
        return $this->hasMany(UserSocial::className(), ['social_id' => 'social_id']);
    }
}
