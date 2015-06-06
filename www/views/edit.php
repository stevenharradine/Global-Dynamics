<?php
	require_once ('ViewModel.php');

	class EditView2 extends View {
		public function render ($data) {
			$customId = $data->getCustomId ();
			$hiddenId = $data->getCustomId () . 'id';
			$deleteHref = $data->getSubmitPage () . '?action=delete_' . $data->getCustomId () . 'by_id&amp;' . $data->getCustomId () . 'id=' . $data->getId ();
echo $data->getCustomId ();
?>



<?php if ( !isAjax() ) { ?>
<section class="edit">
<?php } ?>
	<h2 id="editTitle"><?php echo $data->getTitle(); ?></h2>
	<form action="<?php echo $data->getSubmitPage (); ?>" method="post" id="edit_stocks" class="form">
		<input type="hidden" name="action" value="<?php echo $data->getAction(); ?>" />
		<input type="hidden" name="<?php echo $hiddenId ?>" value="<?php echo $data->getId (); ?>" />
<?php
	while ( $data->hasMore() ) {
		$row = $data->getCurrentRow ();

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
		}

		$data->seekNext();
	}
?>
		<input class="save" type="submit" value="Save" id="editSave"> <a class="delete" href='<?php echo $deleteHref; ?>'>Delete</a>
	</form>
<?php if ( !isAjax() ) { ?>
</section>
<?php } ?>



<?php
		}
	}