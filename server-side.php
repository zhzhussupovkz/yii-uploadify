<?php

//server side example
//if uploader = 'site/upload' add this code to SiteController
//server side exapmle
public function actionUpload()
{
	if(isset($_FILES['Filedata']))
	{
		$model = new MyModel;
		$model->title = $_POST['title'];
		$model->image = CUploadedFile::getInstanceByName('Filedata');
		if ($model->save())
		{
			if($model->image !== null)
			{
				$filename = Yii::app()->request->baseUrl.'/avatars/'.$model->id.'_helloworld.jpg';
				$model->image->saveAs($_SERVER["DOCUMENT_ROOT"].$filename);
			}
		}
		else
			throw new CHttpException(500, 'Internal server error');
		Yii::app()->end();
	}
}