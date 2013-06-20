<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="en"/>
		<title><? echo $this->localize('Authentication'); ?></title>
		<link href="<? echo $this->getApplication()->getConfiguration('cheeseUrl'); ?>css/style.css" rel="stylesheet" title="Default" type="text/css" />
	</head>
	<body>
		<div id="document">
			<h1>
				<? echo $this->localize('Authentication'); ?>

			</h1>
			<form action="<? echo $this->link('Authentication/signIn'); ?>" method="post">
				<fieldset>
					<table class="content">
						<tbody class="body">
<? foreach ($Fields as $n => $Field): ?>
							<tr class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
								<td class="field">
									<? echo $this->localize($Field->getLabel()); ?>

								</td>
								<td>
<? if ($Field instanceof PasswordField): ?>
									<input type="password" name="<? echo $Field->getName(); ?>" value=""/>
<? else: ?>
									<input type="text" name="<? echo $Field->getName(); ?>" value="<? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ''; ?>"/>
<? endif; ?>
								</td>
							</tr>
<? endforeach; ?>
						</tbody>
						<tfoot class="foot">
							<tr class="last">
								<td>
									&nbsp;
								</td>
								<td>
									<input class="submit" type="submit" name="submit" value="<? echo $this->localize('Submit'); ?>"/>
								</td>
							</tr>
						</tfoot>
					</table>
				</fieldset>
			</form>
		</div>
	</body>
</html>