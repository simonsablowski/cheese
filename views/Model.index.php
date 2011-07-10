<? $this->displayView('components/header.php'); ?>
			<h1>
				<a href="<? echo $this->getApplication()->getConfiguration('baseUrl') . $ObjectName; ?>/index" title="<? echo $this->localize($ObjectName); ?>"><? echo $this->localize($ObjectName); ?></a>
			</h1>
			<div class="options">
				<a class="option" href="<? echo $this->getApplication()->getConfiguration('baseUrl') . $ObjectName; ?>/create" title="<? echo $this->localize('Create'); ?>"><? echo $this->localize('Create'); ?></a>
			</div>
			<table class="content">
				<thead class="head">
					<tr>
						<td class="number">
							&nbsp;
						</td>
<? foreach ($Fields as $n => $Field): ?>
						<th>
							<? echo $this->localize($Field->getLabel()); ?>

						</th>
<? endforeach; ?>
						<th class="option">
							&nbsp;
						</th>
						<th class="option">
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody class="body">
<? foreach ($Objects as $n => $Object): ?>
					<tr class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
						<td class="<? if ($n + 1 == count($Objects)): ?>last <? endif; ?>number">
							<? echo $n + 1; ?>

						</td>
<? foreach ($Fields as $n => $Field): ?>
						<td class="<? if ($n + 1 == count($Objects)): ?>last <? endif; ?>data">
<? if ($Field instanceof OptionsField): ?>
							<? echo $this->localize($Object->getData($Field->getName())); ?>
<? elseif ($Field instanceof ObjectField): ?>
							<? try { $getObjectName = $Field->getGetObjectName(); echo $Object->$getObjectName() ? $Object->$getObjectName()->getData($Field->getTitleField()) : ''; } catch (Exception $Error) { echo ''; } ?>
<? elseif ($Field instanceof JsonEncodedField): ?>
<? $this->displayView('components/StdObject.php', array(
	'StdObject' => $Field->decode($Object->getData($Field->getName())),
	'indent' => 7
)); ?>
<? else: ?>
							<? echo $Object->getData($Field->getName()); ?>
<? endif; ?>

						</td>
<? endforeach; ?>
						<td class="<? if ($n + 1 == count($Objects)): ?>last <? endif; ?>option">
							<a href="<? echo $this->getApplication()->getConfiguration('baseUrl') . $ObjectName; ?>/update/<? echo implode('/', $Object->getPrimaryKeyValue()); ?>" title="<? echo $this->localize('Update'); ?>"><? echo $this->localize('Update'); ?></a>
						</td>
						<td class="<? if ($n + 1 == count($Objects)): ?>last <? endif; ?>option">
							<a href="<? echo $this->getApplication()->getConfiguration('baseUrl') . $ObjectName; ?>/delete/<? echo implode('/', $Object->getPrimaryKeyValue()); ?>" title="<? echo $this->localize('Delete'); ?>"><? echo $this->localize('Delete'); ?></a>
						</td>
					</tr>
<? endforeach; ?>
				</tbody>
			</table>
<? $this->displayView('components/footer.php'); ?>