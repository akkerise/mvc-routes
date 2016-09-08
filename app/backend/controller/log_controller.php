<?php 
	/**
	* 
	*/
	class log_controller extends base_controller
	{	
		public function view(){
			if (isset($_SESSION['admin'])) {
				header('location:'.BASE_PATH.'/admin');
			}else{
				$this->loadAdminView('log');
			}
		}

		public function check(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (isset($_POST['username']) && isset($_POST['password'])) {
					$error = [];
					$username = $_POST['username'];
					$password = $_POST['password'];
					helper::oldInputLogin($username,$password);
					// Check regex username
					// echo "1";
					if (!Validation::isValidUser($username)) {
						$error = "loi";
						helper::setError('ErrUser','Sai Định Dạng Username');
						// echo "1";
					}
					// Check regex password
					if (!Validation::isValidPass($password)) {
						$error = "loi";
						helper::setError('ErrPass','Sai Định Dạng Password');
						// echo "1";
					}
					// echo "1";
					// 
					if (!empty($error)) {
						helper::setError('Err','Còn Lỗi Username hoặc Password');
					}else{
						
						$this->loadModel('log_admin');
						// echo "1";
						var_dump($this->model->checkLog($username,$password));
						if ($this->model->checkLog($username,$password)) {
							echo "Đăng Nhập Thành Công";
							$_SESSION['admin'] = $username;
		                    $_SESSION['admin_id'] = $this->model->getIdByName($username)['id'];
		                    unset($_SESSION['input']);
		                    // header("Location:" . BASE_PATH . "/admin ");
		                    // echo "1";
						}else{
							helper::setError('ErrLog','Lỗi Đăng Nhập Do Không Có Tài Khoản Và Password');
							// header('location'.BASE_PATH.'/admin/log');
							echo "1";
						}
					}

				}else{
					header('location'.BASE_PATH.'/admin/log');
				}
			}
		}

	}