<?php
    include 'database/Crud.php';


    $obj = new Crud();

    $data = [
        'user_name' => 'David Warner',
        'user_age' => 30,
    ];

    $obj->insert('user',$data);
    
?>