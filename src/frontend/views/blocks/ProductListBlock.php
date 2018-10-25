<?php
/**
 * View file for block: ProductListBlock
 *
 * File has been created with `block/create` command.
 *
 * @param $this ->cfgValue('limit');
 * @param $this ->cfgValue('pageSize');
 * @param $this ->cfgValue('pageSizeLimit');
 * @param $this ->varValue('category');
 * @param $this ->extraValue('dataProvider');
 *
 * @var   $this \luya\cms\base\PhpBlockView
 */
?>

<?php echo \yii\widgets\ListView::widget([
    'view' => $this,
    'itemView' => '_productCard',
    'dataProvider' => $this->extraValue('dataProvider'),
]) ?>