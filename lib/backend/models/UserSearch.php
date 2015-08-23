<?php
namespace backend\models;

use backend\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User {
	public $item_name;
	public function rules() {
		return [

			[['id', 'username', 'email', 'status', 'created_at', 'updated_at'], 'safe'],
		];
	}

	public function scenarios() {
		return Model::scenarios();
	}

	public function search($params) {
		$query = User::find();

		$query->joinWith('authAssignment');

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!(($this->load($params) && $this->validate()))) {
			return $dataProvider;
		}

		$query->andFilterWhere(['like', 'username', $this->content])
		      ->andFilterWhere(['like', 'email', $this->status])

		      ->andFilterWhere(['like', 'status', $this->status])
		      ->andFilterWhere(['like', 'created_at', $this->created_at])
		      ->andFilterWhere(['like', 'updated_at', $this->updated_at])

		      ->andFilterWhere(['like', 'authAssignment.item_name', $this->item_name]);

		return $dataProvider;

	}
}

?>