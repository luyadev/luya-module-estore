<?php
/**
 * View file for block: ProductDetailBlock 
 *
 * File has been created with `block/create` command. 
 *
 * @param $this->extraValue('product');
 *
 * @var $this \luya\cms\base\PhpBlockView
 */

/** @var \luya\estore\models\Product|\luya\estore\models\Product $model */
$model = $this->extraValue('product');
$model = $model->products[0];

$image = $model->hasMethod('getThumbnail') ? $model->getThumbnail() : false;

?>

<?php if ($image) : ?>
    <?php echo \luya\lazyload\LazyLoad::widget([
        'src' => $image->source,
        'width' => $image->resolutionWidth,
        'height' => $image->resolutionHeight,
    ]) ?>
<?php endif ?>

<h1><?php echo $model->name ?></h1>

<?php if ($description = $model->getData('description')) : ?>
    <?php echo $description ?>
<?php endif ?>
