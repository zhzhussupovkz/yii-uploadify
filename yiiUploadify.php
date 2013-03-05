<?php

class yiiUploadify extends CInputWidget
{
	//id
	protected $id = 'file_upload';

	//options jquery uploadify: www.uploadify.com 
	public $options = array();

	//run widget
	public function run()
	{
		$this->allScripts();
		echo CHtml::fileField($this->id, '', array('id' => $this->id));
		$script = '$(function(){
			$("#'.$this->id.'").uploadify('.CJavaScript::encode($this->options, false).');
		});';
		Yii::app()->clientScript->registerScript('yiiUploadify', $script, CClientScript::POS_HEAD);
	}

	//access scripts
	protected function allScripts()
	{
		$assets=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$baseUrl=Yii::app()->assetManager->publish($assets);
		if(is_dir($assets))
		{
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/jquery.uploadify.min.js', CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerCssFile($baseUrl.'/css/uploadify.css');
			$this->options['swf'] = $baseUrl.'/uploadify.swf';
		}
		else
		{
			throw new Exception('Error in yiiUploadify widget! Cannot access assets folder');
		}
	}
}