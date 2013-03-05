<?php
/* @var $this SiteController */
/* @var $model MyModel */
/* @var $form CActiveForm */
?>

<h1>yiiUpload test</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mymodel-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class='row'>
	<?php echo $form->labelEx($model,'image'); ?><br/>
	<?php $this->widget('ext.yii-uploadify.yiiUploadify', array(
		'options' => array(
			'uploader' => Yii::app()->createUrl('site/upload'),
			'buttonClass' => 'uploadify',
			'buttonText' => 'Upload',
			'onUploadComplete' => 'js:function(){alert("Hello world!")}',
			'formData' => 'js: {"title" : "'.$model->title.'"}',
		),
	));
	?>
	<?php echo $form->error($model,'image'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->