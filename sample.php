<?php
	include("function_diagram.class.php");
	//new function_diagram(horizental dimention, vertical dimention, background color_red_, background color_green_, 
	//						background color_blue_,  arc color_red_, arc color_green_, arc color_blue_, function, 
	//						calculation step, parameter to determine grid drawing);
	//---- a test, gets these parameters from index.html as a form . 
	$show=new function_diagram($_GET["x"],$_GET["y"],$_GET["br"],$_GET["bg"],$_GET["bb"],$_GET["ar"],$_GET["ag"],$_GET["ab"],$_GET["eq"],$_GET["step"],$_GET["hasgrid"]);
	//---- call draw mwthod of created object to get the diagram as a jbg file.
	$show->draw();	
?>