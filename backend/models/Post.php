<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 *
 * @property Comment[] $comments
 * @property User $author
 * @property PostCategory[] $postCategories
 */
class Post extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'post';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['title', 'content', 'status', 'author_id'], 'required'],
			[['content', 'tags'], 'string'],
			[['status', 'create_time', 'update_time', 'author_id'], 'integer'],
			[['title'], 'string', 'max' => 128],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'content' => Yii::t('app', 'Content'),
			'tags' => Yii::t('app', 'Tags'),
			'status' => Yii::t('app', 'Status'),
			'create_time' => Yii::t('app', 'Create Time'),
			'update_time' => Yii::t('app', 'Update Time'),
			'author_id' => Yii::t('app', 'Author ID'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getComments() {
		return $this->hasMany(Comment::className(), ['post_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAuthor() {
		return $this->hasOne(User::className(), ['id' => 'author_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPostCategories() {
		return $this->hasMany(PostCategory::className(), ['post_id' => 'id']);
	}

	public function getAllCategorys() {
		$all = \backend\models\Category::find()->all();
		return \yii\helpers\ArrayHelper::map($all, 'id', 'title');
	}

	public function getSelectedCategory() {
		$selected = [];
		if ($this->isNewRecord != 1) {
			$selected = \yii\helpers\ArrayHelper::getColumn(\backend\models\PostCategory::findAll(['post_id' => $this->id]),
				function ($element) {
					return $element['category_id'];
				});
		}

		return $selected;
	}

	public function afterSave($insert, $changedAttributes) {
		$selected = Yii::$app->request->post('PostCategory');
		\backend\models\PostCategory::deleteAll(['post_id' => $this->id]);
		$insert_data = [];
		foreach ($selected as $v) {
			$insert_data[] = [$this->id, $v];
		}

		Yii::$app->db->createCommand()->batchInsert('post_category', ['post_id', 'category_id'], $insert_data)->execute();
	}
}
