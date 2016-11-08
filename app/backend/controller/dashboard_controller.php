<?php
class dashboard_controller extends base_controller
{
    function view(){
       if(isset($_SESSION['admin'])){
            $this->loadModel('dashboard_admin');
            $this->loadAdminView('dashboard',array(
                'totalPosts' => $this->model->getTotalPosts(),
                'totalUsers' => $this->model->getTotalUsers(),
                'newestPosts' => $this->model->getNewestPosts(),
            ));
//           unset($_SESSION['admin']);
       }else{
           header("Location:".BASE_PATH."/admin/login");
       }
    }
}