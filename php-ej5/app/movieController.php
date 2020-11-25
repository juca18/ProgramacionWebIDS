<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    include "connectionController.php";

    if (isset($_POST['action'])){
        $movieController = new movieController();

        switch ($_POST['action']) {
            case 'store':
                $title = strip_tags($_POST['title']);
                $description = strip_tags($_POST['description']);
                $minutes = strip_tags($_POST['minutes']);
                $clasification = strip_tags($_POST['clasification']);
                $category_id = strip_tags($_POST['category_id']);
                var_dump($_POST);
                $movieController->store($title, $description, $minutes, $clasification, $category_id);
            break;
        }
    }

    class MovieController{

        public function get(){
            $conn = connect();
            if ($conn->connect_error==false){
                $query = "select * from movies";
                $prepared_query = $conn->prepare($query);
                $prepared_query->execute();

                $results = $prepared_query->get_result();
                $movies = $results->fetch_all(MYSQLI_ASSOC);

                if (count($movies)>0){
                    return $movies;
                }else{
                    return array();
                }

            }else{
                return array();
            }
        }

        public function store($title, $description, $minutes, $clasification, $category_id){
            $conn = connect();
            if ($conn->connect_error==false){

                if($title!="" && $description!="" && $minutes!="" && $clasification && $category_id){
                    
                    $target_path = "../assets/img/movies/"; 
                    $only_name = $_FILES['cover']['name'];
                    $new_file_name = $target_path.basename($_FILES['cover']['name']);

                    if (move_uploaded_file($_FILES['cover']['tmp_name'], $new_file_name)){
  
                        $query = "insert into movies (title, description, cover, minutes, clasification, category_id) VALUES(?,?,?,?,?,?)";

                        $prepared_query = $conn->prepare($query);
                        $prepared_query->bind_param('sssisi', $title, $description, $only_name, $minutes, $clasification, $category_id);
                        if ($prepared_query->execute()){
                            $_SESSION['success'] = 'El registro se ha guardado correctamente';
                            header("Location:".$_SERVER["HTTP_REFERER"]);
                        }else{
                            $_SESSION['error'] = 'Verifica los datos ingresados';
                            header("Location:".$_SERVER["HTTP_REFERER"]);
                        }

                    }else{
                        $_SESSION['error'] = 'La imagen no fue subida';
                        header("Location:".$_SERVER["HTTP_REFERER"]);
                    }


                }else{
                    $_SESSION['error'] = 'verifique la informacion del formulario';
                    header("Location:".$_SERVER["HTTP_REFERER"]);
                }

            }else{
                $_SESSION['error'] = 'verifique la conexion a la base de datos';
                header("Location:".$_SERVER["HTTP_REFERER"]);
            }
        }

    }
?>