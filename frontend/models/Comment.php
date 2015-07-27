<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 *
 * @property TblPost $post
 */
class Comment extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public $verifyCode;

	public static function tableName() {
		return 'tbl_comment';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['content', 'author', 'post_id'], 'required'],
			[['content'], 'string'],
			[['status', 'create_time', 'post_id'], 'integer'],
			[['author', 'email', 'url'], 'string', 'max' => 128],
			['verifyCode', 'captcha'],

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => Yii::t('app', 'ID'),
			'content' => Yii::t('app', 'Content'),
			'status' => Yii::t('app', 'Status'),
			'create_time' => Yii::t('app', 'Create Time'),
			'author' => Yii::t('app', 'Author'),
			'email' => Yii::t('app', 'Email'),
			'url' => Yii::t('app', 'Url'),
			'post_id' => Yii::t('app', 'Post ID'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPost() {
		return $this->hasOne(TblPost::className(), ['id' => 'post_id']);
	}
}
