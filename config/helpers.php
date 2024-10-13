<?php

if (!function_exists('dd')) {
    /**
     * Dump and Die - display the contents of a variable and stop the script execution.
     *
     * @param mixed $data
     * @return void
     */
    function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }
}
