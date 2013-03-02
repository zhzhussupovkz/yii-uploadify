<?php

//server side example
//if ajaxUrl = 'site/upload' add this code to SideController
public function actionUpload()
{
	// Define a destination
	$targetFolder =  Yii::app()->request->baseUrl.'/uploads';

	if (!empty($_FILES))
	{
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
		$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];

		// Validate the file type
		$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
		$fileParts = pathinfo($_FILES['Filedata']['name']);

		if (in_array($fileParts['extension'],$fileTypes)) 
		{
			move_uploaded_file($tempFile,$targetFile);
		}
		else
		{
			echo 'Invalid file type.';
		}
	}
}