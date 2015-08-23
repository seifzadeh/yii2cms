<?php
namespace backend\models;

use backend\models\Post;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PostSearch extends Post {
	public function rules() {
		return [

			[['title', 'content', 'status', 'author_id', 'tags', 'create_time', 'update_time'], 'safe'],
		];
	}

	public function scenarios() {
		return Model::scenarios();
	}

	public function search($params) {
		$query = Post::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!(($this->load($params) && $this->validate()))) {
			return $dataProvider;
		}

		$query->andFilterWhere(['like', 'title', $this->title])
		      ->andFilterWhere(['like', 'content', $this->content])
		      ->andFilterWhere(['like', 'tags', $this->tags])
		      ->andFilterWhere(['like', 'status', $this->status])
		      ->andFilterWhere(['like', 'create_time', $this->create_time])
		      ->andFilterWhere(['like', 'update_time', $this->update_time])
		      ->andFilterWhere(['like', 'author_id', $this->author_id]);

		return $dataProvider;

	}
}

?>