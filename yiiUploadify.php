<?php

class yiiUploadify extends CInputWidget
{
	//input file name
	public $name = 'file_upload';

	//button text
	public $buttonText = 'Hello world!';

	//AJAX URL
	public $ajaxUrl;

	//button height
	public $height = '30';

	//button width
	public $width = '120';

	//multiupload
	public $multi = 'true';

	//path to uploadify.swf
	protected  $swfPath;

	//id
	protected $id = 'file_upload';

	//turn on/off the SWFUpload debugging mode.
	public $debug = 'false';

	//run widget
	public function run()
	{
		echo '<div id="queue" class = "uploadify"></div>';
		echo CHtml::fileField($this->name, '', array('id' => $this->id));
		$this->allScripts();
		$script = '$(function(){
		$("#'.$this->id.'").uploadify({
			height	: '.$this->height.',
			width : '.$this->width.',
			buttonText : "'.$this->buttonText.'",
			swf : "'.$this->swfPath.'",
			uploader : "'.$this->ajaxUrl.'",
			multi: '.$this->multi.',
			debug : '.$this->debug.',
		});
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
			$this->swfPath = $baseUrl.'/uploadify.swf';
		}
		else
		{
			throw new Exception('Error in yiiUploadify widget! Cannot access assets folder');
		}
	}
}