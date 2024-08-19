<?php

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function redirect($path)
{
    header("Location: " .$_ENV['ROOT']."/".$path);
    die;
}