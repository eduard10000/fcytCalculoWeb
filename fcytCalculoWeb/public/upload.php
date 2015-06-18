<?php
$output_dir = "upload_temp/";
$ext_supports=array("html","gif","png","bmp","jpg");
if(isset($_FILES["file"]))
{
	//Filter the file types , if you want.
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Error: " . $_FILES["file"]["error"] . "
		";
	}
	else
	{

	$ext=end((explode(".", $_FILES["file"]["name"]))); // saber extension

	$valido=false;
	foreach($ext_supports as $ext_support )
	{
		if($ext_support == $ext)
		{
			// guarda temporalmente
			move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir. $_FILES["file"]["name"]);
			echo $_FILES["file"]["name"];
			$valido=true;
			break;
		}
	}
	
	if($valido == false)
		echo "extension del archivo ".$_FILES["file"]["name"]."no aceptada"; // si no funciona el programa
	}

}
?>