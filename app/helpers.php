<?php

if (!function_exists('paginationOffset')) {

    function paginationOffset($page, $per_page)
    {
        return ($page - 1) * $per_page;
    }
}

if (!function_exists('allEntitiesLoaded')) {

    function allEntitiesLoaded($total_entities, $page, $per_page)
    {
        return ($page * $per_page) >= $total_entities;
    }
}
