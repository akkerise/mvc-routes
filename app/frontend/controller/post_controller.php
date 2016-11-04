<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/8/16
 * Time: 2:35 PM
 */
class post_controller extends base_controller
{
    public function view($param = null)
    {
        $limit = 5;
        if (empty($param)) {
            $this->loadModel('post');
            $totalPost = $this->model->getCountPost();
            // var_dump($totalPost);
            $totalPage = ceil($totalPost / $limit);

            if (!isset($_GET['page'])) {
                $page = 1;
            }elseif (filter_var($_GET['page'],FILTER_SANITIZE_NUMBER_INT) && $_GET['page'] < $totalPage) {
                $page = $_GET['page'];
            }else{
                $page =1;
            }
            $getDataByPage = $this->model->getDataByPage($page);
            var_dump($getDataByPage);
            $data = $this->model->getAllData();
            $this->loadView('post',array(
                    'data' => $data
                ));
        } else {
            // xu ly o cho co param truoc nha
            $this->loadModel('post');
            // this->model la mot object cua post_model

            $result = $this->model->getDataById($param);

//            echo "<pre>";var_dump($result);echo "</pre>"; exit;

            $this->loadView('detail-post',array(
                'post' => $result
            ));
        }
    }





}