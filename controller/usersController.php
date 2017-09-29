<?php
class usersController extends baseController{
     
    public function __construct() {
        parent::__construct();
    }
     
    public function index(){
         
        //Creamos el objeto usuario
        $user=new user();
         
        //Conseguimos todos los usuarios
        $allusers=$users->getAll();
        
        //Cargamos la vista index y le pasamos valores
        $this->view("index",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));
    }
     
    public function create(){
        if(isset($_POST["name"])){
             
            //Creamos un usuario
            $user=new Usuario();
            $user->setNombre($_POST["name"]);
            $user->setApellido($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword(sha1($_POST["password"]));
            $save=$user->save();
        }
        $this->redirect("users", "index");
    }
     
    public function borrar(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
             
            $user=new user();
            $user->deleteById($id); 
        }
        $this->redirect();
    }
     
     
    public function hello(){
        $users=new usersModel();
        $usu=$users->getAUser();
        var_dump($usu);
    }
 
}
?>