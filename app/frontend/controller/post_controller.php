<?php
class post_controller extends base_controller
{
    public function view($param = null)
    {
        $limit = 5;
        if (empty($param)) {
            $this->loadModel('post');
            $totalPost = $this->model->getCountPost()['count(*)'];
            // echo "<pre>"; var_dump($totalPost); echo "</pre>"; exit;
            $totalPage = intval(ceil($totalPost / $limit));
            // kiểm tra biến totalPage
            // var_dump($totalPage);exit;
            // kiểm tra biến $page được lấy từ $_GET['page'] trên trình duyệt
            if (!isset($_GET['page'])) {
                // nếu $_GET['page'] không tồn tại thì trả về 1 tức là trang số 1
                // chúng ta sẽ có dữ liệu của trang đầu tiên được lấy từ hàm getDataByPage($page)
                $page = 1;
            }elseif (filter_var($_GET['page'],FILTER_SANITIZE_NUMBER_INT) && $_GET['page'] < $totalPage) {
                // kiểm tra $_GET['page'] xem có phải là số nguyên và nó phải nhỏ hơn tổng số trang $totalPage
                $page = $_GET['page'];
            }else{
                // tất cả các trường hợp còn lại thì mặc định $page = 1
                $page =1;
            }
            $getDataByPage = $this->model->getDataByPage($page);
            // var_dump($getDataByPage);exit();
            // $data = $this->model->getAllData();
            $this->loadView('post',array(
                    'data' => $getDataByPage,
                    'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
                    'total_page' => $totalPage,

                ));
        } else {
            // kiểm tra param xem có phải số nguyên dương hay không
            if (!filter_var($param,FILTER_SANITIZE_NUMBER_INT)) {
                header('location:'.BASE_PATH.'/p404');
            }else{
                // loadModel . $this->model là một object của loadModel
                $this->loadModel('post');
                // lấy được dữ liệu của bài post thông qua id của nó
                $result = $this->model->getDataById($param);
                // kiểm tra xem biến $result có lấy được dữ liệu hay không
                // echo "<pre>";var_dump($result);echo "</pre>"; exit;

                // đẩy dữ liệu lấy được đó ra trang detail-post
                $this->loadView('detail-post',array(
                    'post' => $result
                ));
            }
        }
    }
}