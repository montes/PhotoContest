<?php ?>
<form action="?save_new_photo_contest" method="post">
    <p>
    	<label for="contest_name">
    		<?php _e('Photo Contest Name') ?>
    	</label>
    	<input type="text" name="contest_name" id="contest_name">
    </p>
    <p>
    	<label for="contest_rounds">
    		<?php _e('Rounds') ?>
    	</label>
    	<input type="text" name="contest_rounds" id="contest_rounds">
    </p>
    <p>
    	<label for="max_votes_first_rounds">
    		<?php _e('Maximum votes at first rounds') ?>
    	</label>
    	<input type="text" name="max_votes_first_rounds" id="max_votes_first_rounds">
    </p>
    <p>
    	<label for="max_votes_last_round">
    		<?php _e('Maximum votes at last round') ?>
    	</label>
    	<input type="text" name="max_votes_last_round" id="max_votes_last_round">
    </p>        
    <p>
    	<input type="submit" name="new_contest_submit" value="<?php _e('Create Contest'); ?>">
    </p>

</form>