<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 */
class Role extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'auth_item';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['name'], 'required'],
			[['type', 'created_at', 'updated_at'], 'integer'],
			[['description', 'data'], 'string'],
			[['name', 'rule_name'], 'string', 'max' => 64],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'name' => Yii::t('app', 'Name'),
			'type' => Yii::t('app', 'Type'),
			'description' => Yii::t('app', 'Description'),
			'rule_name' => Yii::t('app', 'Rule Name'),
			'data' => Yii::t('app', 'Data'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAuthAssignments() {
		return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRuleName() {
		return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAuthItemChildren() {
		return $this->hasMany(AuthItemChild::className(), ['parent' => 'name']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAuthItemChildren0() {
		return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
	}

	private function all_roles() {
		return [
			'post' => [
				['name' => 'admin_post', 'checked' => 0, 'label' => 'Admin Post'],
				['name' => 'add_post', 'checked' => 0, 'label' => 'Add Post'],
				['name' => 'edit_post', 'checked' => 0, 'label' => 'Edit Post'],
				['name' => 'delete_post', 'checked' => 0, 'label' => 'Delete Post'],
			],
			'comment' => [
				['name' => 'admin_comment', 'checked' => 0, 'label' => 'Admin Comment'],
				['name' => 'add_comment', 'checked' => 0, 'label' => 'Add Comment'],
				['name' => 'edit_commant', 'checked' => 0, 'label' => 'Edit Comment'],
				['name' => 'delete_comment', 'checked' => 0, 'label' => 'Delete Comment'],
			],
			'category' => [
				['name' => 'admin_ctegory', 'checked' => 0, 'label' => 'Admin Category'],
				['name' => 'add_category', 'checked' => 0, 'label' => 'Add Category'],
				['name' => 'edit_category', 'checked' => 0, 'label' => 'Edit Category'],
				['name' => 'delete_category', 'checked' => 0, 'label' => 'Delete Category'],
			],
			'user' => [
				['name' => 'admin_user', 'checked' => 0, 'label' => 'Admin User'],
				['name' => 'add_user', 'checked' => 0, 'label' => 'Add User'],
				['name' => 'edit_user', 'checked' => 0, 'label' => 'Edit User'],
				['name' => 'delete_user', 'checked' => 0, 'label' => 'Delete User'],
			],
		];
	}

	public function getAllRoles() {
		$roles = $this->all_roles();
		if (!$this->isNewRecord) {
			$db_all = (new \yii\db\Query())
				->select(['child'])
				->from('auth_item_child')
				->where(['parent' => $this->name])
				->all();
			$db_roles = [];
			foreach ($db_all as $kdb => $vdb) {
				array_push($db_roles, $vdb['child']);
			}

			foreach ($roles as $k => $v) {
				foreach ($v as $kv => $cv) {
					if (in_array($cv['name'], $db_roles)) {
						$roles[$k][$kv]['checked'] = 1;
					}
				}
			}
		}

		return $roles;

	}

	public function save($runValidation = true, $attributeNames = NULL) {
		$t = time();

		if (!$this->isNewRecord) {
			$sql = "DELETE FROM `auth_item_child` WHERE `parent`='{$this->name}'";
			Yii::$app->db->createCommand($sql)->query();
		}

		$form_roles = Yii::$app->request->post('Items');
		$sql = "INSERT IGNORE INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('{$this->name}', 1, '{$this->description}', NULL, NULL, $t, $t)";
		Yii::$app->db->createCommand($sql)->query();

		if (count($form_roles) > 0) {
			foreach ($form_roles as $kr => $vr) {
				$sql = "INSERT IGNORE INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES ('$kr', 2, 'Create a post', NULL, NULL, $t, $t)";
				Yii::$app->db->createCommand($sql)->query();

				$sql = "INSERT IGNORE INTO `auth_item_child` (`parent`, `child`) VALUES ('{$this->name}', '$kr')";
				Yii::$app->db->createCommand($sql)->query();

			}
		}

		return true;
	}
}
