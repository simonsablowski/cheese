<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="en"/>
		<title><? echo $this->localize('Error'); ?></title>
		<link href="<? echo $this->getApplication()->getConfiguration('basePath'); ?>css/style.css" rel="stylesheet" title="Default" type="text/css" />
	</head>
	<body>
		<div id="document">
			<h1>
				<? echo $this->localize('Unfortunately,'); ?>
			</h1>
			<h2>
				<? echo $this->localize('we encountered an error:'); ?>
			</h2>
			<dl class="content">
				<dt class="head">
					<? echo $this->localize('Field'); ?>
				</dt>
				<dd class="head">
					<? echo $this->localize('Value'); ?>
				</dd>
<? $fields = array('Type', 'Message'); if ($this->getApplication()->getConfiguration('debugMode')) $fields = array_merge($fields, array('Details', 'Trace')); ?>
<? foreach ($fields as $n => $field): ?>
				<dt class="<? if ($n + 1 == count($fields)) echo 'last '; echo $n % 2 ? 'odd' : 'even'; ?>">
					<? echo $this->localize($field); ?>
				</dt>
				<dd class="<? if ($n + 1 == count($fields)) echo 'last '; echo $n % 2 ? 'odd' : 'even'; ?>">
					<? $getter = 'get' . $field; ?>
					<? if ($field != 'Trace'): ?>
					<? print_r($Error->$getter()); ?>
					<? else: ?>
					<div class="highlight">
						<? var_dump($Error->$getter()); ?>
					</div>
					<? endif; ?>

				</dd>
<? endforeach; ?>
			</dl>
		</div>
	</body>
</html>