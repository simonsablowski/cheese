<? $this->displayView('components/header.php'); ?>
			<h1>
				<a href="<? echo $ObjectName; ?>/index" title="<? echo $ObjectName; ?>"><? echo $this->localize($ObjectName); ?></a> &raquo; <? echo $this->localize(ucfirst($mode)); ?>

			</h1>
			<form action="<? echo sprintf('%s/%s', $ObjectName, $mode != 'update' ? $mode : sprintf('%s/%d', $mode, $Object->getId())); ?>" method="post">
				<fieldset>
					<dl class="content">
						<dt class="head">
							<? echo $this->localize('Field'); ?>
						</dt>
						<dd class="head">
							<? echo $this->localize('Value'); ?>
						</dd>
<? foreach ($Fields as $n => $Field): ?>
						<dt class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
							<? echo $this->localize($Field->getLabel()); ?>

						</dt>
						<dd class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
<? if ($Field instanceof TextField): ?>
<?/* if (is_null($Field->getLength()) || $Field->getLength() > 255): ?>
							<textarea name="<? echo $Field->getName(); ?>" style="width: 75%;"><? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ($mode == 'update' && isset($Object) ? $Object->getData($Field->getName()) : ''); ?></textarea>
<? else: */?>
							<input type="text" name="<? echo $Field->getName(); ?>" value="<? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ($mode == 'update' && isset($Object) ? $Object->getData($Field->getName()) : ''); ?>" style="width: 75%;" maxlength="<? echo $Field->getLength(); ?>"/>
<?/* endif; */?>
<? else: if ($Field instanceof OptionsField): ?>
<? if (count($Field->getOptions()) > 2): ?>
							<select name="<? echo $Field->getName(); ?>">
<? foreach ($Field->getOptions() as $m => $Option): ?>
								<option value="<? echo $Option->getName(); ?>"<? echo $this->getRequest()->getData($Field->getName()) == $Option->getName() ? ' checked="checked"' : ($mode == 'update' && isset($Object) && $Object->getData($Field->getName()) == $Option->getName() ? ' checked="checked"' : ''); ?>><? echo $this->localize($Option->getLabel()); ?></option>
<? endforeach; ?>
							</select>
<? else: ?>
							<div class="options">
<? foreach ($Field->getOptions() as $m => $Option): ?>
								<div class="option">
									<input id="<? echo ($id = $Field->getName() . $Option->getName()); ?>" type="radio" name="<? echo $Field->getName(); ?>" value="<? echo $Option->getName(); ?>"<? echo $this->getRequest()->getData($Field->getName()) == $Option->getName() ? ' checked="checked"' : ($mode == 'update' && isset($Object) && $Object->getData($Field->getName()) == $Option->getName() ? ' checked="checked"' : ($Option->isDefault() ? ' checked="checked"' : '')); ?>>
									<label for="<? echo $id; ?>">
										<? echo $this->localize($Option->getLabel()); ?>
									</label>
								</div>
<? endforeach; ?>
							</div>
<? endif; ?>
<? endif; ?>
<? endif; ?>
						</dd>
<? endforeach; ?>
						<dt class="last <? echo $n % 2 ? 'even' : 'odd'; ?>">
							&nbsp;
						</dt>
						<dd class="last <? echo $n % 2 ? 'even' : 'odd'; ?>">
							<input type="submit" name="submit" value="<? echo $this->localize('Submit'); ?>"/>
						</dd>
					</dl>
				</fieldset>
			</form>
<? $this->displayView('components/footer.php'); ?>