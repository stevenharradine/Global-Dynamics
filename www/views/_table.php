<section class="table-manager">
	<table>
		<thead>
			<tr>
<?php
	$headings = $tableView->getHeadings();
	foreach ($headings as $heading) {
?>
				<th><?php echo $heading; ?></th>
<?php
	}
?>
			</tr>
		</thead>
		<tbody>
<?php
	while ( $tableView->hasMore() ) {
		$cells = $tableView->getCurrentRow();

		echo '<tr>';
		foreach ($cells as $cell) {
?>
		<td class="<?php echo $cell['html_id']; ?>"><?php echo $cell['data']; ?></td>
<?php
		}
		echo '</tr>';

		$tableView->seekNext();
	}
?>
		</tbody>
	</table>
</section>