<?php

    include_once "../app/movieController.php";
    $movieController = new movieController();

    $movies = $movieController->get();

    //echo json_encode($categories);
?>

<html>
    <head>
        <title>Consulta</title>
        <style type="text/css">
            table, th, td{
                border: 1px solid black;
            }
            fieldset{
                weight:100px;
            }
            #updateForm{
                display: none;
            }
        </style>
    </head>
    <body>
        <?php
            if(isset($_SESSION) && isset($_SESSION['error'])){
                echo "<h3>Error: ".$_SESSION['error']."</h3>";
                unset($_SESSION['error']);
            }
        ?>

        <table>

            <thead>
                <th>
                    #
                </th>
                <th>
                    Title
                </th>
                <th>
                    Cover
                </th>
                <th>
                    Minutes
                </th>
                <th>
                    Category
                </th>

            </thead>

            <tbody>

                <?php foreach ($movies as $movie): ?>

                <tr>
                    <td>
                        <?= $movie['id'] ?>
                    </td>
                    <td>
                        <?= $movie['title'] ?>
                    </td>
                    <td>
                        <img src=<?= "../assets/img/movies/".$movie['cover'] ?>  alt="">    
                    </td>
                    <td>
                        <?= $movie['minutes'] ?>
                    </td>
                    <td>
                        <?= $movie['category_id'] ?>
                    </td>
                    
                </tr>
                <?php endforeach ?>

            </tbody>

        </table>

        <form action="../app/movieController.php" method="POST" enctype="multipart/form-data">
            <fieldset>

                <legend>
                    Add movie
                </legend>

                <label>
                    Title
                </label>
                <input type="text" name="title" placeholder="Title" required=""> 
                <br>

                <label>
                    Description
                </label>
                <textarea placeholder="description" name="description" rows="5" required=""></textarea>
                <br>

                <label>
                    Cover
                </label>
                <input type="file" name="cover" require="" accept="image/*">
                <br>

                <label>
                    Minutes
                </label>
                <input type="number" name="minutes" placeholder="Minutes" required="">
                <br>

                <label>
                    Clasification
                </label>
                <select name="clasification">
                    <option> B15 </option>
                    <option> B18 </option>
                </select>
                <br>

                <label>
                    Categoria id
                </label>
                <select name="category_id">
                    <option> Terror </option>
                    <option> Drama </option>
                </select>
                <br>

                <button type="submit" >Add movie</button>
                <input type="hidden" name="action" value="store">

            </fieldset>
        </form>

    </body>
</html>