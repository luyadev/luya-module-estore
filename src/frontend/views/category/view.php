<?php
/**
 * @var \luya\estore\models\Group $model
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$block = new \luya\estore\frontend\blocks\ProductListBlock();
$block->setVarValues([
    'category' => $model->id,
])
?>

<?php echo $block->renderFrontend() ?>
