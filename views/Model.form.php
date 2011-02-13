<? $this->displayView('components/header.php'); ?>
			<h1>
				<? echo ucfirst($mode); ?> <? echo $ObjectName; ?>
			</h1>
			<form action="<? echo sprintf('%s%s/%s', $this->getConfiguration('basePath'), $ObjectName, $mode != 'update' ? $mode : sprintf('%s/%d', $mode, $Object->getId())); ?>" method="post">
				<fieldset>
					<dl class="content">
						<dt class="head">
							&nbsp;
						</dt>
						<dd class="head">
							Value
						</dd>
<? foreach ($Fields as $n => $Field): ?>
						<dt class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
							<? echo $Field->getLabel(); ?>
						</dt>
						<dd class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
<? switch ($Field->getType()): ?>
<? default: ?>
							<input type="text" name="<? echo $Field->getName(); ?>" value="<? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ($mode == 'update' && isset($Object) ? $Object->getData($Field->getName()) : ''); ?>" style="width: 75%;" maxlength="255"/>
<? break; ?>
<? endswitch; ?>
						</dd>
<? endforeach; ?>
						<dt class="<? echo $n % 2 ? 'even' : 'odd'; ?>">
							&nbsp;
						</dt>
						<dd class="<? echo $n % 2 ? 'even' : 'odd'; ?>">
							<input type="submit" name="submit" value="Submit"/>
						</dd>
					</dl>
				</fieldset>
			</form>
<? $this->displayView('components/footer.php'); ?>