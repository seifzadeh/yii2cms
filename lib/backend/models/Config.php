<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $_name
 * @property string $_value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_name', '_value'], 'required'],
            [['_value'], 'string'],
            [['_name'], 'string', 'max' => 200],
            [['_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            '_name' => Yii::t('app', 'Name'),
            '_value' => Yii::t('app', 'Value'),
        ];
    }
}
