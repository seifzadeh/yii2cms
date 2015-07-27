<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $profile
 *
 * @property TblPost[] $tblPosts
 */
class User extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['username', 'password', 'salt', 'email'], 'required'],
			[['profile'], 'string'],
			[['username', 'password', 'salt', 'email'], 'string', 'max' => 128],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => Yii::t('app', 'ID'),
			'username' => Yii::t('app', 'Username'),
			'password' => Yii::t('app', 'Password'),
			'salt' => Yii::t('app', 'Salt'),
			'email' => Yii::t('app', 'Email'),
			'profile' => Yii::t('app', 'Profile'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTblPosts() {
		return $this->hasMany(TblPost::className(), ['author_id' => 'id']);
	}

	/**
	 * @inheritdoc
	 * @return UserQuery the active query used by this AR class.
	 */
	public static function find() {
		return new UserQuery(get_called_class());
	}
}
