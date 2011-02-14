<? $this->displayView('components/header.php'); ?>
			<h1>
				<a href="<? echo $ObjectName; ?>/index" title="<? echo $ObjectName; ?>"><? echo $ObjectName; ?></a> &raquo; <? echo ucfirst($mode); ?>

			</h1>
			<form action="<? echo sprintf('%s/%s', $ObjectName, $mode != 'update' ? $mode : sprintf('%s/%d', $mode, $Object->getId())); ?>" method="post">
				<fieldset>
					<dl class="content">
						<dt class="head">
							Field
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
<? case 'text': ?>
							<input type="text" name="<? echo $Field->getName(); ?>" value="<? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ($mode == 'update' && isset($Object) ? $Object->getData($Field->getName()) : ''); ?>" style="width: 75%;" maxlength="<? echo $Field->getLength(); ?>"/>
<? break; ?>
<? case 'FieldOptions': ?>
<? if (count($Field->getFieldOptions()) > 2): ?>
							<select name="<? echo $Field->getName(); ?>">
<? foreach ($Field->getFieldOptions() as $m => $FieldOption): ?>
								<option value="<? echo $FieldOption->getName(); ?>"<? echo $this->getRequest()->getData($Field->getName()) == $FieldOption->getName() ? ' checked="checked"' : ($mode == 'update' && isset($Object) && $Object->getData($Field->getName()) == $FieldOption->getName() ? ' checked="checked"' : ''); ?>><? echo $FieldOption->getLabel(); ?></option>
<? endforeach; ?>
							</select>
<? else: ?>
							<div class="options">
<? foreach ($Field->getFieldOptions() as $m => $FieldOption): ?>
								<div class="option">
									<input id="<? echo ($id = $Field->getName() . $FieldOption->getName()); ?>" type="radio" name="<? echo $Field->getName(); ?>" value="<? echo $FieldOption->getName(); ?>"<? echo $this->getRequest()->getData($Field->getName()) == $FieldOption->getName() ? ' checked="checked"' : ($mode == 'update' && isset($Object) && $Object->getData($Field->getName()) == $FieldOption->getName() ? ' checked="checked"' : ($FieldOption->isDefault() ? ' checked="checked"' : '')); ?>>
									<label for="<? echo $id; ?>">
										<? echo $FieldOption->getLabel(); ?>
									</label>
								</div>
<? endforeach; ?>
							</div>
<? endif; ?>
<? break; ?>
<? endswitch; ?>
						</dd>
<? endforeach; ?>
						<dt class="last <? echo $n % 2 ? 'even' : 'odd'; ?>">
							&nbsp;
						</dt>
						<dd class="last <? echo $n % 2 ? 'even' : 'odd'; ?>">
							<input type="submit" name="submit" value="Submit"/>
						</dd>
					</dl>
				</fieldset>
			</form>
<? $this->displayView('components/footer.php'); ?>