<?php
/**
 * @var $model \luya\estore\models\Product
 * @var $key string|integer
 * @var $index integer
 *
 * @var $this \luya\cms\base\PhpBlockView
 */

use luya\estore\frontend\helpers\Url;

$image = $model->hasMethod('getThumbnail') ? $model->getThumbnail() : false;

?>

<article>
	<a href="<?php echo Url::toProduct($model) ?>">
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
	</a>
</article>
