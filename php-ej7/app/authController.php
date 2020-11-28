<?php 
    include "app.php";
    include_once "connectionController.php";
    include "../layouts/alerts.template.php";

    if (isset($_POST['action'])){

        if (isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'] ) {
            $authController = new authController();

            switch ($_POST['action']) {
                case 'access':
                    $email = strip_tags($_POST['email']);
                    $password = strip_tags($_POST['password']);
    
                    $authController->access($email, $password);
                break;
                case 'store':
                    $name = strip_tags($_POST['name']);
                    $lastname = strip_tags($_POST['lastname']);
                    $birthdate = strip_tags($_POST['birthdate']);
                    $email = strip_tags($_POST['email']);
                    $password = ($_POST['password']);
    
                    $authController->store($name, $lastname, $birthdate, $email, $password);
                break;            
                
            }
        }else{
            $_SESSION['error'] = 'Error de seguridad';
            header("Location:".$_SERVER["HTTP_REFERER"]);
        }


    }

class AuthController
{
    public function store($name, $lastname, $birthdate, $email, $password){
        $conn = connect();
        if ($conn->connect_error==false){

            if($name!="" && $lastname!="" && $birthdate!="" && $email!="" && $password!=""){
                $originalPassword = $password; 
                $password = sha1($password.'ahperro');

                $query = "insert into users (name, lastname, birthdate, email, password) VALUES(?,?,?,?,?)";

                $prepared_query = $conn->prepare($query);
                $prepared_query->bind_param('sssss', $name, $lastname, $birthdate, $email, $password);
                if ($prepared_query->execute()){
                    //$_SESSION['success'] = 'El registro se ha guardado correctamente';
                    //header("Location:".$_SERVER["HTTP_REFERER"]);
                    $this->access($email,$originalPassword);
                    //$authController->access($email, $password);
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

	public function access($email,$password)
	{
        $conn = connect();
        if ($conn->connect_error==false){
            $password = sha1($password.'ahperro');
            echo($password." ".$email);
            $query = "select * from users where email = ? and password = ?";
            $prepared_query = $conn->prepare($query);
            $prepared_query->bind_param('ss', $email, $password);
            if ($prepared_query->execute()){
                $results = $prepared_query->get_result();
                $user = $results->fetch_all(MYSQLI_ASSOC);
                if($user){
                    $_SESSION['id'] = $user[0]['id'];
                    $_SESSION['name'] = $user[0]['name'];
                    $_SESSION['email'] = $user[0]['email'];
                    $_SESSION['role'] = $user[0]['role'];
                    
                    if ($_SESSION['role']=="admin") {
                        header("Location:".BASE_PATH."categories");
                    }else{
                        header("Location:".BASE_PATH."categories");
                    }
                }
                else{
                    $_SESSION['error'] = 'Datos de inicio de session incorrectos';
                    header("Location:".$_SERVER["HTTP_REFERER"]);
                }
            }

        }else{
            $_SESSION['error'] = 'verifique la conexion a la base de datos';
            header("Location:".$_SERVER["HTTP_REFERER"]);
        }
    }

	public function logout()
	{
        session_destroy();
	}

}



?>