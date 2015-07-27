
<?php
use yii\widgets\ListView;
echo ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => 'item_show',
]);

?>