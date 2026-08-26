<?php

    function conexion(){

    $host = "host=dpg-da7fkcs9v7es73bihf5g-a.virginia-postgres.render.com";
    $port = "port=5432";
    $dbname = "dbname=test_db_im2w";
    $user = "user=test_db_im2w_user";
    $password = "password=GlvQHvpGflHcgjUuugeHSlV8FV6o0Y2S";

    $db = pg_connect("$host $port $dbname $user $password");

    return $db;
}

?>