<?php if ( !isAjax() ) { ?>
<section class="edit">
<?php } ?>
	<h2 id="editTitle"><?php echo $editView->getTitle(); ?></h2>
	<form action="<?php echo $editView->getSubmitPage (); ?>" method="post" id="edit_stocks" class="form">
		<input type="hidden" name="action" value="<?php echo $editView->getAction(); ?>" />
		<input type="hidden" name="<?php echo $data->getCustomId (); ?>id" value="<?php echo $editView->getId (); ?>" />
<?php
	while ( $editView->hasMore() ) {
		$row = $editView->getCurrentRow ();

		if ($row['type'] == 'text') {
?>
			<div><label for="<?php echo $row['html_id']; ?>"><?php echo $row['label']; ?></label><input id="<?php echo $row['html_id']; ?>" name="<?php echo $row['html_id']; ?>" type="text" value="<?php echo $row['value']; ?>"<?php echo $row['attr'] != null ? ' ' . $row['attr'] : ''; ?> /></div>
<?php
		} else if ($row['type'] == 'option') {
?>
			<select name="<?php echo $row['html_id']; ?>">
<?php
			foreach ($row['options'] as $option) {
?>
				<option value="<?php echo $option; ?>" <?php echo $option == $row['selected'] ? ' selected="selected"' : ''; ?>><?php echo $option; ?></option>
<?php
			}
?>
			</select>
<?php			
		} else if ($row['type'] == 'textarea') {
?>
			<div><label for="<?php echo $row['html_id']; ?>"><?php echo $row['label']; ?></label><textarea id="<?php echo $row['html_id']; ?>" name="<?php echo $row['html_id']; ?>" type="text" <?php echo $row['attr'] != null ? ' ' . $row['attr'] : ''; ?>><?php echo $row['value']; ?></textarea></div>
<?php

		}

		$editView->seekNext();
	}
?>
		<input class="save" type="submit" value="Save" id="editSave"> <a class="delete" href='./?action=<?php echo $data->getSubmitPage (); ?>&amp;id=<?php echo $editView->getId (); ?>'>Delete</a>
	</form>
<?php if ( !isAjax() ) { ?>
</section>
<?php } ?>