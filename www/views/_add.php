<?php if ( isset ($addView) ) { ?>
<section class="add">
	<h2><?php echo $addView->getTitle(); ?></h2>
<?php if ( isset ( $db_write_success ) && $db_write_success ) { echo "added"; } ?>
	<form action="<?php echo $addView->getAction(); ?>" method="post" id="add_stock" class="form">
<?php
	if ( $addView->getPageAction() != null ) {
?>
		<input type="hidden" name="action" value="<?php echo $addView->getPageAction(); ?>" />
<?php
	}

	while ( $addView->hasMore() ) {
		$row = $addView->getCurrentRow ();

		if ($row['type'] == 'text') {
?>
			<div><label for="<?php echo $row['html_id']; ?>"><?php echo $row['label']; ?></label><input id="<?php echo $row['html_id']; ?>" name="<?php echo $row['html_id']; ?>" type="text" <?php echo $row['default_value'] != null ? ' value="' . $row['default_value'] . '"' : ''; ?> <?php echo $row['placeholder'] != null ? ' placeholder="' . $row['placeholder'] . '"' : ''; ?> /></div>
<?php
		} else if ($row['type'] == 'option') {
?>
			<select name="<?php echo $row['html_id']; ?>">
<?php
			foreach ($row['options'] as $option) {
?>
				<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
<?php
			}
?>
			</select>
<?php
		}

		$addView->seekNext();
	}
?>
		<input type="submit" value="Add">
	</form>
</section>
<?php } ?>