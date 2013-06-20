<? $this->displayView('components/header.php'); ?>
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
<? $this->displayView('components/footer.php'); ?>