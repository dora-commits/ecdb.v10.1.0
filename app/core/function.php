<?php

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function redirect($path)
{
    // show($path);
    header("Location: " .$_ENV['ROOT']."/".$path);
    // show("Location: " .$_ENV['ROOT']."/".$path);
    die;
}