<? $this->displayView('components/header.php'); ?>
			<h1>
				<a href="<? echo $this->link('Authentication/signIn'); ?>" title="<? echo $this->localize('Authentication'); ?>"><? echo $this->localize('Authentication'); ?></a>&ensp;&raquo;&ensp;<? echo $this->localize('Sign In'); ?>

			</h1>
			<form action="<? echo $this->link('Authentication/signIn'); ?>" method="post">
				<fieldset>
					<table class="narrow content">
						<thead class="head">
							<tr>
								<th class="field" colspan="2">
									<? echo $this->localize('Sign In'); ?>

								</th>
							</tr>
						</thead>
						<tbody class="body">
<? foreach ($Fields as $n => $Field): ?>
							<tr class="even">
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
<? $this->displayView('components/footer.php'); ?>