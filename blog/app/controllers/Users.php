<?php
    require_once '../app/helpers/session_helper.php';
?>
<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = 'Email is already taken.';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Password must be at least 8 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Filter data
            $data['username'] = htmlspecialchars($data['username']);
            $data['email'] = htmlspecialchars($data['email']);
            $data['password'] = htmlspecialchars($data['password']);
            $data['confirmPassword'] = htmlspecialchars($data['confirmPassword']);
            

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Sha256 password
                $data['password'] = hash('sha256', $data['password']);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URL_ROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users/register', $data);
    }

    public function login() {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];
            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            // Filter data
            $data['username'] = filter_var($data['username'], FILTER_SANITIZE_STRING);
            $data['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);


            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';

                    $this->view('users/login', $data);
                }
            }

        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/login', $data);
    }

    public function createUserSession($user) {
        session_start();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['username'] = $user->user_name;
        $_SESSION['email'] = $user->user_email;
        header('location:' . URL_ROOT . '/pages/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        session_destroy();
        header('location:' . URL_ROOT . '/users/login');
    }

    // profile page
    public function profile() 
    {
        if(!IsLoggedIn())
        {     
            header('location: ' . URL_ROOT . '/pages');
        }
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $post = $this->userModel->getPostsByUser($_SESSION['user_id']);
        $data = [
            'title' => 'Profile',
            'user' => $user,
            'posts' => $post

        ];
        $this->view('users/profile', $data);
    }

    // update profile
    public function update_profile()
    {
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $post = $this->userModel->getPostsByUser($_SESSION['user_id']);
        if(!isLoggedIn() && $post->user_id != $_SESSION['user_id'])
        {
            header("Location: " . URL_ROOT . "/users/profile");
        }
        $data = [
            'title' => 'Update Profile',
            'user' => $user,
            'posts' => $post

        ];
        // Post request
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'fullname' => trim($_POST['fullname']),
                'email' => trim($_POST['email']),
                'birthday' => trim($_POST['birthday']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'descript' => trim($_POST['descript']),
                'Error' => '',
            ];
                if(!$this->userModel->update_profile($data))
                {
                    header("Location: " . URL_ROOT . "/users/profile");
                }
                else
                {
                    // catch error

                    die('Something went wrong.');
                }
        }
    
        $this->view('users/profile', $data);
    }
    // update_avatar

    public function update_avatar()
    {
        if(!IsLoggedIn())
        {     
            header('location: ' . URL_ROOT . '/pages');
        }
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        // Post request
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Get file 
            $file = $_FILES['file'];
            $fileName = rand().$file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
            // Get file extension
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png');
            // Check mime type file
            try 
            {
                $mime_type = $_FILES["file"]["type"];
                if (!in_array($mime_type, ["image/jpeg", "image/png", "image/gif"]))
                    die("Hack detected");
            
            } catch(Exception $e) {
                $error = $e->getMessage();
                die($error);
            } 


            if(in_array($fileActualExt, $allowed))
            {
                if($fileError === 0)
                {
                    if($fileSize < 1000000)
                    {
                        $fileDestination = BLOG_ROOT . "\\uploads\\" . $fileName;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $data['user_id'] = $_SESSION['user_id'];
                        $data['user_avatar'] = "..\\..\\app\\uploads\\" .$fileName;
                        if(!$this->userModel->update_avatar($data))
                        {
                            $data = [
                                'title' => 'Update Profile',
                                'user' => $user,
                                'fullname' => $user->user_fullname,
                                'email' => $user->user_email,
                                'birthday' => $user->user_birthday,
                                'phone' => $user->user_phone,
                                'address' => $user->user_address
                            ];
                            header('location: ' . URL_ROOT . '/users/profile');
                        }
                        else
                        {
                            // catch error
                            die('Something went wronggg');
                        }
                    }
                    else
                    {
                        die('File too big');
                    }
                }
                else
                {
                    die('Something went wrong?');
                }
            }
            else
            {
                die('You cannot upload files of this type');
            }
        }
        $data = [
            'title' => 'Update Profile',
            'user' => $user,
            'fullname' => $user->user_fullname,
            'email' => $user->user_email,
            'birthday' => $user->user_birthday,
            'phone' => $user->user_phone,
            'address' => $user->user_address
        ];
        $this->view('users/profile', $data);
    }

    
}