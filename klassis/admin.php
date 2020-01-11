<?php

include 'cms.php';

include 'header.php';

?>

	<form>
		<div class="form-group">
			<label for="heading">Heading</label>
			<input type="text" class="form-control" name="heading" id="heading" placeholder="Some title time?">
		</div>

		<div class="form-group">
			<label for="bodytext">Body text</label>
			<textarea class="form-control" name="bodytext" id="bodytext" rows="3"></textarea>
		</div>
		<button type="submit">Save me!</button>
	</form>

<?php

include 'footer.php';