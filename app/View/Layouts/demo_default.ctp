<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout;?> | Origin Demo</title>
	<link rel="shortcut icon" href="/favicon.ico"/>
	<?php
		echo $this->Minify->css(array('demo/public.css'));
		echo $this->Minify->script(array('jquery/jquery', 'angular/angularjs', 'apps/demoDefaultApp'));
	?>
</head>
<body ng:app="demoDefaultApp">
	<?php echo $this->fetch('content'); ?>
</body>
</html>
