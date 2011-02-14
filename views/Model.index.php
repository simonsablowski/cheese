<? $this->displayView('components/header.php'); ?>
			<h1>
				<a href="<? echo $ObjectName; ?>/index" title="<? echo $ObjectName; ?>"><? echo $ObjectName; ?></a>
			</h1>
			<table class="content">
				<thead class="head">
					<tr>
						<td class="number">
							&nbsp;
						</td>
<? foreach ($Fields as $n => $Field): ?>
						<th>
							<? echo $Field->getLabel(); ?>

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
						<td class="<? if ($n + 1 == count($Objects)) echo 'last '; ?>number">
							<? echo $n + 1; ?>

						</td>
<? foreach ($Fields as $n => $Field): ?>
						<td class="<? if ($n + 1 == count($Objects)) echo 'last '; ?>data">
							<? echo $Object->getData($Field->getName()); ?>

						</td>
<? endforeach; ?>
						<td class="<? if ($n + 1 == count($Objects)) echo 'last '; ?>option">
							<a href="<? echo $ObjectName; ?>/update/<? echo $Object->getId(); ?>" title="Update">Update</a>
						</td>
						<td class="<? if ($n + 1 == count($Objects)) echo 'last '; ?>option">
							<a href="<? echo $ObjectName; ?>/delete/<? echo $Object->getId(); ?>" title="Delete">Delete</a>
						</td>
					</tr>
<? endforeach; ?>
				</tbody>
			</table>
<? $this->displayView('components/footer.php'); ?>