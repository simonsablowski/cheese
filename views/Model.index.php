<? $this->displayView('components/header.php'); ?>
			<h1>
				<? echo $ObjectName; ?>
			</h1>
			<table class="content">
				<thead class="head">
					<tr>
						<td class="number">
							&nbsp;
						</td>
<? foreach ($Fields as $n => $Field): ?>
						<th class="data">
							<? echo $Field->getLabel(); ?>
						</th>
<? endforeach; ?>
						<th class="option">
							Update
						</th>
						<th class="option">
							Delete
						</th>
					</tr>
				</thead>
				<tbody class="body">
<? foreach ($Objects as $n => $Object): ?>
					<tr class="<? echo $n % 2 ? 'odd' : 'even'; ?>">
						<td class="number">
							<? echo $n + 1; ?>
						</td>
<? foreach ($Fields as $n => $Field): ?>
						<td class="data">
							<? echo $Object->getData($Field->getName()); ?>
						</td>
<? endforeach; ?>
						<td class="option">
							<a href="update/<? echo $Object->getId(); ?>" title="Update">Update</a>
						</td>
						<td class="option">
							<a href="delete/<? echo $Object->getId(); ?>" title="Delete">Delete</a>
						</td>
					</tr>
<? endforeach; ?>
				</tbody>
			</table>
<? $this->displayView('components/footer.php'); ?>