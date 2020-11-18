<?php

    switch ($_POST['option']) {
        case 1:
            echo ($_POST['value1']+$_POST['value2']);
        break;
        case 2:
            echo ($_POST['value1']-$_POST['value2']);
        break;
        case 3:
            echo ($_POST['value1']*$_POST['value2']);
        break;
        case 4:
            echo ($_POST['value1']/$_POST['value2']);
        break;
    }

?>
