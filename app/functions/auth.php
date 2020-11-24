<?php

/**
 * Function checks whether the user has logged in;
 * checks whether user (password and email) exists in database;
 *
 * @return bool
 */
function is_logged_in(): bool {

    if ($_SESSION) {
        $db_data = file_to_array(DB_FILE);

        foreach ($db_data as $user) {
            if (($user['email'] === $_SESSION['email'])
                && ($user['password'] === $_SESSION['password'])) {

                return true;
            }
        }
    }

    return false;
}

/**
 * Function ends the session
 *
 * @param null $redirected
 */
function logout($redirected = null): void {
    $_SESSION = [];
    session_destroy();

    if ($redirected) {
        header("location: /$redirected");
    }
}

