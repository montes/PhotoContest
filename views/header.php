<?php if ($user->isAdmin()): ?>

    <ul id="pc_admin_menu">
        <li>
            [ADMIN MENU]
        </li>
        <li>
            [<?php _e('Current state'); echo ': ' . $options['state']; ?>]
        </li>
        <?php
            switch ($options['state']) {
                case 'closed':
                    echo '<li><a href="?create_new_photo_contest">'.
                        __('Create New Photo Contest').
                        '</a></li>';
                    break;
                case 'uploading_photos':
                    echo '<li><a href="?pause_photo_uploading">'.
                        __('Pause Photo Uploading').
                        '</a></li>';
                    echo '<li><a href="?start_voting">'.
                        __('Start Voting').
                        '</a></li>';
                    break;
                case 'pause_photo_uploading':
                    echo '<li><a href="?resume_photo_uploading">'.
                        __('Resume Photo Uploading').
                        '</a></li>';
                    break;
                case 'voting':
                    echo '<li><a href="?pause_voting">'.
                        __('Pause Voting').
                        '</a></li>';
                    if ($options['rounds'] > $options['current_round']) {
                        for (
                            $round = $options['current_round']; 
                            $round <= $options['total_rounds']; 
                            $round++
                            ) {
                            echo '<li><a href="?set_round_'.$round.'">'.
                                __('Set Round').' '.$round.
                                '</a></li>';
                        }
                    }
                    break;
                case 'pause_voting':
                    echo '<li><a href="?resume_voting">'.
                        __('Resume Voting').
                        '</a></li>';
                    break;
            }
?>    
    </ul>

<?php endif; ?>

