<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="/css/common.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="/extensions/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="/extensions/syntaxhighlighter/styles/shCoreDefault.css" />
    <link rel="stylesheet" href="/extensions/jqueryui-editable/css/jqueryui-editable.css" />
    <link rel="stylesheet" href="/extensions/jquery.jqplot/jquery.jqplot.min.css" />
	<script type="text/javascript" src="/extensions/jquery/external/jquery/jquery.js"></script>
	<script type="text/javascript" src="/extensions/jquery/jquery-ui.js"></script>
	<script type="text/javascript" src="/extensions/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="/extensions/syntaxhighlighter/scripts/shCore.js"></script>
    <script type="text/javascript" src="/extensions/syntaxhighlighter/scripts/shBrushPhp.js"></script>
	<script type="text/javascript" src="/extensions/jqueryui-editable/js/jqueryui-editable.min.js"></script>
    <script type="text/javascript" src="/extensions/jquery.jqplot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="/scripts/common.js"></script>
	<script type="text/javascript">
		SyntaxHighlighter.all();
		$.fn.editable.defaults.mode = 'inline';
	</script>
	<title><?php echo App::getParam('title') ?></title>
</head>
<body>
<header>
	<div class="logo">
		Labs
	</div>
	<ul class="nav nav-tabs">
		<li <?php if(!isset($isCode)) echo 'class="active"' ?>><a href="<?php if(isset($isCode)) echo "{$isCode}";?>">Result</a></li>
		<li <?php if(isset($isCode)) echo 'class="active"' ?>><a href="<?php if(!isset($isCode)) echo "?code";?>">Code</a></li>
	</ul>
</header>
<?php
new sideBarWidget(
        ["1", "2", "3", "4", "5", "6", "7", "8"],
        ["First Lab", "Second Lab", "Third Lab", "Fourth Lab", "Fivth Lab", "Sixth Lab", "IDZ", "Exam"],
        isset($tabNumber) ? $tabNumber - 1 : 0
);
?>
<div class="content">
	<?php $this->generateContent() ?>
</div>
<footer>
	<p>
		Powered by Victor Fedorenko
	</p>
</footer>
</body>
</html>