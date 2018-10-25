<?php
/**
 * @var \luya\estore\models\Product|\luya\estore\models\behaviors\DefaultSet $model
 */

$image = $model->hasMethod('getBaseImage') ? $model->getBaseImage() : false;

?>


<?php if ($image) : ?>
    <?php echo \luya\lazyload\LazyLoad::widget([
        'src' => $image->source,
        'width' => $image->resolutionWidth,
        'height' => $image->resolutionHeight,
    ]) ?>
<?php endif ?>
	
	<h1><?php echo $model->name ?></h1>

<?php if ($shortDescription = $model->getData('short_description')) : ?>
	<p><?php echo $shortDescription ?></p>
<?php endif ?>