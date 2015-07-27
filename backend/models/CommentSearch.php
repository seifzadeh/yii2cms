<?php
namespace backend\models;

use backend\models\Comment;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CommentSearch extends Comment {
	public $post_title;
	public function rules() {
		return [

			[['content', 'status', 'create_time', 'author', 'email', 'url', 'post_title'], 'safe'],
		];
	}

	public function scenarios() {
		return Model::scenarios();
	}

	public function search($params) {
		$query = Comment::find();

		$query->joinWith('post');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!(($this->load($params) && $this->validate()))) {
			return $dataProvider;
		}

		$query->andFilterWhere(['like', 'tbl_comment.content', $this->content])
		      ->andFilterWhere(['like', 'status', $this->status])
		      ->andFilterWhere(['like', 'create_time', $this->create_time])
		      ->andFilterWhere(['like', 'author', $this->author])
		      ->andFilterWhere(['like', 'email', $this->email])
		      ->andFilterWhere(['like', 'url', $this->url])
		      ->andFilterWhere(['like', 'tbl_post.title', $this->post_title]);

		return $dataProvider;

	}
}

?>