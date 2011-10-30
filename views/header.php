<?php

    if ($c['user']->isAdmin()) {
        echo 'You are admin!';
    } else {
        echo 'You are not admin!';
    }