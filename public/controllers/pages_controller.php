<?php

class PagesController
{

    /**
     * Displays the home page.
     * Expects a url like: /?controller=pages&action=home
     */
    public function home()
    {
        require_once('views/pages/home.php');
    }

    /**
     * Displays the error page.
     * Expects a url like: /?controller=pages&action=error
     */
    public function error()
    {
        require_once('views/pages/error.php');
    }
}

?>