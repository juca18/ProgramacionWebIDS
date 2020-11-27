<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    include "connectionController.php";

    if (isset($_POST['action'])){
        $categoryController = new categoryController();

        switch ($_POST['action']) {
            case 'store':
                $name = strip_tags($_POST['name']);
                $description = strip_tags($_POST['description']);
                $status = strip_tags($_POST['status']);

                $categoryController->store($name, $description, $status);
            break;
            case 'update':
                $name = strip_tags($_POST['name']);
                $description = strip_tags($_POST['description']);
                $status = strip_tags($_POST['status']);
                $id = strip_tags($_POST['id']);

                $categoryController->update($id, $name, $description, $status);
            break;
            case 'destroy':
                $id = strip_tags($_POST['id']);
                $categoryController->destroy($id);
            break;
            
        }
    }

    class CategoryController{

        public function get(){
            $conn = connect();
            if ($conn->connect_error==false){
                $query = "select * from categories";
                $prepared_query = $conn->prepare($query);
                $prepared_query->execute();

                $results = $prepared_query->get_result();
                $categories = $results->fetch_all(MYSQLI_ASSOC);

                if (count($categories)>0){
                    return $categories;
                }else{
                    return array();
                }

            }else{
                return array();
            }
        }

        public function store($name, $description, $status){
            $conn = connect();
            if ($conn->connect_error==false){

                if($name!="" && $description!="" && $status!=""){
                    $query = "insert into categories (name, description, status) VALUES(?,?,?)";

                    $prepared_query = $conn->prepare($query);
                    $prepared_query->bind_param('sss', $name, $description, $status);
                    if ($prepared_query->execute()){
                        $_SESSION['success'] = 'El registro se ha guardado correctamente';
                        header("Location:".$_SERVER["HTTP_REFERER"]);
                    }else{
                        $_SESSION['error'] = 'Verifica los datos ingresados';
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

        public function update($id, $name, $description, $status){
            $conn = connect();
            if ($conn->connect_error==false){

                if($name!="" && $description!="" && $status!=""){
                    $query = "update categories set name = ?, description = ?, status = ? WHERE id = ?";

                    $prepared_query = $conn->prepare($query);
                    //echo($name." ".$description." ".$status." ".$id);
                    $prepared_query->bind_param('sssi', $name, $description, $status, $id);
                    if ($prepared_query->execute()){
                        $_SESSION['success'] = 'El registro se ha guardado correctamente';
                        header("Location:".$_SERVER["HTTP_REFERER"]);
                    }else{
                        $_SESSION['error'] = 'Verifica los datos ingresados';
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

        public function destroy($id){
            $conn = connect();
            if ($conn->connect_error==false){

                if($id!=""){
                    $query = "delete from categories WHERE id = ?";

                    $prepared_query = $conn->prepare($query);
                    $prepared_query->bind_param('i', $id);
                    if ($prepared_query->execute()){
                        $_SESSION['success'] = 'El registro se ha guardado correctamente';
                        header("Location:".$_SERVER["HTTP_REFERER"]);
                    }else{
                        $_SESSION['error'] = 'Verifica los datos ingresados';
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