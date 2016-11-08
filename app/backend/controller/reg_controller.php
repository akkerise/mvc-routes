<?php
include dirname(PATH_APPLICATION) . "/libs/Helper.php";
include dirname(PATH_APPLICATION) . "/libs/Validation.php";
class reg_controller extends base_controller
{
    public function view(){
        $this->loadAdminView('reg');
    }

    public function check(){
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $repassword = $_POST['password'];
            helper::oldInputResgister($username,$password,$repassword,$email);
            if (isset($username) && isset($password) && isset($repassword) && isset($email)){
                $error = [];
                if (!Validation::isValidUser($username)){
                    $error = 'Lỗi regex username';
                    helper::setError('ErrorUsername','Lỗi Username Regex');
                    echo "<pre>";var_dump(1);echo "</pre>"; exit;
                }
                if (!Validation::isValidPass($password)){
                    $error = 'Lỗi regex password';
                    helper::setError('ErrorPassword','Lỗi Password Regex');
                    echo "<pre>";var_dump(1);echo "</pre>"; exit;
                }
                if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $error = 'Lỗi định dạng email';
                    helper::setError('ErrorEmail','Lỗi Email Định Dạng');
                    echo "<pre>";var_dump(1);echo "</pre>"; exit;
                }
                if ($password !== $repassword){
                    $error = 'Error password';
                    helper::setError('ErrorRepassword','Password không trùng nhau ! Bạn nên nhập lại ...');
                    echo "<pre>";var_dump('Password không trùng nhau');echo "</pre>"; exit;
                }
                if (!empty($error)){
                    helper::setError('Error','Còn sai ở đâu đó . Bạn nên check lại phía trên');
                    echo "<pre>";var_dump(1);echo "</pre>"; exit;
                }else{
                    $this->loadModel('reg_admin');
//                    echo "<pre>";var_dump($this->model->checkReg($username,$email));echo "</pre>"; exit;
                    if ($this->model->checkReg($username,$email) == true){
                        header('location:'.BASE_PATH.'/admin/reg');
                        helper::setError('Error','Đã tồn tại Username or Email');
                        echo "<pre>";var_dump('Đã tồn tại Username or Email');echo "</pre>"; exit;
                    }else{
                        $hashpass = password_hash($password,PASSWORD_BCRYPT);
                        if ($this->model->insertUser($username,$hashpass,$email) == false){
                            helper::setError('Error','Thất bại cmnr');
                            echo "<pre>";var_dump('Thất bại khi insert User');echo "</pre>"; exit;
                        }else{
                            helper::setMes('Success','Bạn đã đăng ký thành công cmnr');
                            echo "<pre>";var_dump('Login nào');echo "</pre>"; exit;
//                            header('location:'.BASE_PATH.'/admin/log');
                        }
                    }
                }
            }
        }else{
//            header('location:'.BASE_PATH.'/admin/reg');
            echo "<pre>";var_dump('Đéo đúng method nhé!');echo "</pre>"; exit;
        }
    }
}