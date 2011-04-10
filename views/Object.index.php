<?php
$Coachings = array();
foreach ($Objects as $Object) {
	$Coachings[$Object->getCoachingId()] = $Object->getCoaching();
}
?>
<? $this->displayView('components/header.php'); ?>
			<h1>
				<a href="<? echo $ObjectName; ?>/index" title="<? echo $this->localize($ObjectName); ?>"><? echo $this->localize($ObjectName); ?></a>
			</h1>
			<div class="options">
				<a class="option" href="<? echo $ObjectName; ?>/create" title="<? echo $this->localize('Create'); ?>"><? echo $this->localize('Create'); ?></a>
			</div>
			<table class="content">
				<thead class="head">
					<tr>
						<td class="number">
							&nbsp;
						</td>
						<th>
							<? echo $this->localize('Type'); ?>

						</th>
						<th>
							<? echo $this->localize('Key'); ?>

						</th>
						<th class="main">
							<? echo $this->localize('Title'); ?>

						</th>
						<th class="main">
							<? echo $this->localize('Properties'); ?>

						</th>
						<th>
							<? echo $this->localize('Status'); ?>

						</th>
						<th class="option">
							&nbsp;
						</th>
						<th class="option">
							&nbsp;
						</th>
					</tr>
				</thead>
				<tbody class="body accordeon">
<? foreach ($Coachings as $Coaching): ?>
					<tr id="group<? echo $Coaching->getId(); ?>" class="divider row">
						<td class="field data" colspan="8">
							<? echo $Coaching->getKey(); ?> <em>(<? echo $this->localize('%d objects', count($Coaching->getObjects())); ?>)</em>
						</td>
					</tr>
<? foreach ($Coaching->getObjects() as $n => $Object): ?>
					<tr class="<? echo $n % 2 ? 'odd' : 'even'; ?> group<? echo $Coaching->getId(); ?> row">
						<td class="<? if ($n + 1 == count($Objects)): ?>last <? endif; ?>number">
							<? echo $n + 1; ?>

						</td>
						<td class="field data">
							<? echo $Object->getType(); ?>

						</td>
						<td class="field data">
							<? echo $Object->getKey(); ?>

						</td>
						<td class="main">
							<? echo $Object->getTitle(); ?>

						</td>
						<td class="main">
<? $this->displayView('components/StdObject.php', array(
	'StdObject' => Json::decode($Object->getProperties()),
	'indent' => 7
)); ?>
						</td>
						<td class="last">
							<? echo $this->localize($Object->getStatus()); ?>

						</td>
						<td class="<? if ($n + 1 == count($Objects)): ?>last <? endif; ?>option">
							<a href="<? echo $ObjectName; ?>/update/<? echo implode('/', $Object->getPrimaryKeyValue()); ?>" title="<? echo $this->localize('Update'); ?>"><? echo $this->localize('Update'); ?></a>
						</td>
						<td class="<? if ($n + 1 == count($Objects)): ?>last <? endif; ?>option">
							<a href="<? echo $ObjectName; ?>/delete/<? echo implode('/', $Object->getPrimaryKeyValue()); ?>" title="<? echo $this->localize('Delete'); ?>"><? echo $this->localize('Delete'); ?></a>
						</td>
					</tr>
<? endforeach; ?>
<? endforeach; ?>
				</tbody>
			</table>
<? $this->displayView('components/footer.php'); ?>