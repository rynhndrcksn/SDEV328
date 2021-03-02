<?php
/**
 * This file exist strictly to destroy sessions that may be left over/lingering due to all the different 'sites' there
 * are on the server.
 */

session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(), '', 0, '/');

echo '<h1>Your session has been deleted thoroughly</h1>';