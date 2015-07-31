<?php

namespace backend\controllers;

use backend\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {
	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex() {
		// $dataProviderUser = new ActiveDataProvider([
		// 	'query' => User::find(),
		// ]);

		$query = new \yii\db\Query;
		$query = \backend\models\Role::find()
			->select(['name', 'description'])
			->asArray()
			->where(['`type`' => '1'])
			->orderBy('name');

		$dataProviderRole = new ActiveDataProvider([
			// 'query' => (new \yii\db\Query())->select(['name', 'description'])->from('auth_item')->where(['type' => 1])->all(),
			// 'query' => \backend\models\Role::find()->where(['`type`' => '1'])->all(),
			'query' => $query,
		]);

		$searchModel = new \backend\models\UserSearch();
		$dataProviderUser = $searchModel->search(Yii::$app->request->queryParams);
		// return $this->render('index', [
		// 	'searchModel' => $searchModel,
		// 	'dataProvider' => $dataProvider,
		// ]);

		return $this->render('index', [
			'dataProviderUser' => $dataProviderUser,
			'dataProviderRole' => $dataProviderRole,

		]);
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new User();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->update()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
