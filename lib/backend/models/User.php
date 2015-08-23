<?php

namespace backend\models;

use backend\models\AuthAssignment;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 */
class User extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user';
	}

	public $auth_item;
	public $password;

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['username', 'email'], 'required'],
			[['status', 'created_at', 'updated_at'], 'integer'],
			[['username', 'password_hash', 'password', 'auth_item', 'password_reset_token', 'email'], 'string', 'max' => 255],
			[['auth_key'], 'string', 'max' => 32],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => Yii::t('app', 'ID'),
			'username' => Yii::t('app', 'Username'),
			'auth_key' => Yii::t('app', 'Auth Key'),
			'password_hash' => Yii::t('app', 'Password Hash'),
			'password_reset_token' => Yii::t('app', 'Password Reset Token'),
			'email' => Yii::t('app', 'Email'),
			'status' => Yii::t('app', 'Status'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAuthAssignments() {
		return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
	}

	public function getAuthAssignment() {
		return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
	}

	public function save($runValidation = true, $attributeNames = NULL) {
		$is = false;
		try {
			if ($this->validate()) {
				$user = new \common\models\User();
				$user->username = $this->username;
				$user->email = $this->email;
				if ($this->isNewRecord) {
					$user->setPassword($this->password);
					$user->generateAuthKey();
					$user->status = $this->status == 1 ? 10 : 0;
					if ($user->save()) {

						$this->save_assignment($user->id);

					}
				}

			}
			$is = true;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return true;
	}

	private function save_assignment($user_id) {
		$assignment = new \backend\models\AuthAssignment;
		$assignment->user_id = $user_id;
		$assignment->item_name = $this->auth_item;
		if ($assignment->save()) {
			// echo $this->auth_item;
			$this->id = $user_id;
		} else {
			echo $this->auth_item;
			print_r($assignment->getErrors());
			exit();
		}
	}

	public function update($runValidation = true, $attributeNames = NULL) {
		if (!empty($this->password)) {
			$this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
		}

		$assignment = \backend\models\AuthAssignment::findOne(['user_id' => $this->id]);
		if ($assignment != null) {
			$assignment->item_name = $this->auth_item;
			if (!$assignment->update()) {
				print_r($assignment->getErrors());
				exit();

			}

		} else {
			$this->save_assignment($this->id);
		}
		$this->status = $this->status == 1 ? 10 : 0;

		parent::update();

		return true;
	}
}
