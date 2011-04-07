<? $this->displayView('components/header.php'); ?>
			<h1>
				<a href="<? echo $ObjectName; ?>/index" title="<? echo $ObjectName; ?>"><? echo $this->localize($ObjectName); ?></a>&ensp;&raquo;&ensp;<? echo $this->localize(ucfirst($mode)); ?>

			</h1>
			<form action="<? echo sprintf('%s/%s', $ObjectName, $mode != 'update' ? $mode : sprintf('%s/%s', $mode, implode('/', $Object->getPrimaryKeyValue()))); ?>" method="post">
				<fieldset>
					<table class="content">
						<thead class="head">
							<tr>
								<th class="field">
									<? echo $this->localize('Field'); ?>

								</th>
								<th>
									<? echo $this->localize('Value'); ?>

								</th>
							</tr>
						</thead>
						<tbody class="body">
<? foreach ($Fields as $n => $Field): ?>
							<tr class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
								<td class="field">
									<? echo $this->localize($Field->getLabel()); ?>

								</td>
								<td>
<? if ($Field instanceof TextField && (is_null($Field->getLength()) || $Field->getLength() > 255)): ?>
									<textarea name="<? echo $Field->getName(); ?>" style="width: 75%;"><? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ($mode == 'update' && isset($Object) ? $Object->getData($Field->getName()) : ''); ?></textarea>
<? elseif ($Field instanceof OptionsField): ?>
<? if (count($Field->getOptions()) > 2): ?>
									<select name="<? echo $Field->getName(); ?>">
<? foreach ($Field->getOptions() as $m => $Option): ?>
										<option value="<? echo $Option->getName(); ?>"<? echo $this->getRequest()->getData($Field->getName()) == $Option->getName() ? ' selected="selected"' : ($mode == 'update' && isset($Object) && $Object->getData($Field->getName()) == $Option->getName() ? ' selected="selected"' : ''); ?>><? echo $this->localize($Option->getLabel()); ?></option>
<? endforeach; ?>
									</select>
<? else: ?>
									<div class="options">
<? foreach ($Field->getOptions() as $m => $Option): ?>
										<div class="option">
											<input id="<? echo ($id = $Field->getName() . $Option->getName()); ?>" type="radio" name="<? echo $Field->getName(); ?>" value="<? echo $Option->getName(); ?>"<? echo $this->getRequest()->getData($Field->getName()) == $Option->getName() ? ' checked="checked"' : ($mode == 'update' && isset($Object) && $Object->getData($Field->getName()) == $Option->getName() ? ' checked="checked"' : ($Option->isDefault() ? ' checked="checked"' : '')); ?>/>
											<label for="<? echo $id; ?>">
												<? echo $this->localize($Option->getLabel()); ?>

											</label>
										</div>
<? endforeach; ?>
									</div>
<? endif; ?>
<? elseif ($Field instanceof ObjectField): ?>
									<select name="<? echo $Field->getName(); ?>">
										<option value=""></option>
<? $modelName = $Field->getModelName(); $primaryKey = $Field->getPrimaryKey(); $titleField = $Field->getTitleField(); foreach ($modelName::findAll() as $LoadedObject): ?>
										<option value="<? echo $LoadedObject->getData($primaryKey); ?>"<? echo $this->getRequest()->getData($Field->getName()) == $LoadedObject->getData($primaryKey) ? ' selected="selected"' : ($mode == 'update' && isset($Object) && $Object->getData($Field->getName()) == $LoadedObject->getData($primaryKey) ? ' selected="selected"' : ''); ?>><? echo $LoadedObject->getData($titleField); ?></option>
<? endforeach; ?>
									</select>
<? elseif ($Field instanceof JsonEncodedField): ?>
									<textarea name="<? echo $Field->getName(); ?>" style="width: 75%;"><? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ($mode == 'update' && isset($Object) ? $Object->getData($Field->getName()) : ''); ?></textarea>
<? else: ?>
									<input type="text" name="<? echo $Field->getName(); ?>" value="<? echo ($value = $this->getRequest()->getData($Field->getName())) ? $value : ($mode == 'update' && isset($Object) ? $Object->getData($Field->getName()) : ''); ?>" style="width: 75%;"<?/* maxlength="<? echo !is_null($Field->getLength()) ? $Field->getLength() : ''; ?>"*/?>/>
<? endif; ?>
								</td>
							</tr>
<? endforeach; ?>
						</tbody>
						<tfoot>
							<tr class="last <? echo $n % 2 ? 'even' : 'odd'; ?>">
								<td>
									&nbsp;
								</td>
								<td>
									<input type="submit" name="submit" value="<? echo $this->localize('Submit'); ?>"/>
								</td>
							</tr>
						</tfoot>
					</table>
				</fieldset>
			</form>
<? $this->displayView('components/footer.php'); ?>