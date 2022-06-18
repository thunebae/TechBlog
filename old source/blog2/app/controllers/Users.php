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
        $post = $this->userModel->getPostsByUserFirstPage($_SESSION['user_id']);

        $data = [
            'title' => 'Profile',
            'user' => $user,
            'post' => $post,
        ];
        $this->view('users/profile', $data);
    }

    // update profile
    public function update_profile()
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
            
                                    
            if(!empty($data['fullname']) && !empty($data['birthday']) && !empty($data['phone']) && !empty($data['address'])
                && strlen($_POST['fullname']) <= 255 && strlen($_POST['phone']) <= 255
                && strlen($_POST['address']) <= 255 && strlen($_POST['descript']) <= 500)
            {
                //check value 
                if(trim($_POST['fullname']) == '')
                {
                    $data['fullname'] = $user->user_fullname;
                }
                else
                {
                    $data['fullname'] = trim($_POST['fullname']);
                }
                if(trim($_POST['email']) == '')
                {
                    $data['email'] = $user->user_email;
                }
                else
                {
                    $data['email'] = trim($_POST['email']);
                }
                if(trim($_POST['birthday']) == '')
                {
                    $data['birthday'] = $user->user_birthday;
                }
                else
                {
                    $data['birthday'] = trim($_POST['birthday']);
                }
                if(trim($_POST['phone']) == '')
                {
                    $data['phone'] = $user->user_phone;
                }
                else
                {
                    $data['phone'] = trim($_POST['phone']);
                }

                if(trim($_POST['address']) == '')
                {
                    $data['address'] = $user->user_address;
                }
                else
                {
                    $data['address'] = trim($_POST['address']);
                }

                if(trim($_POST['descript']) == '')
                {
                    $data['descript'] = $user->user_descript;
                }
                else
                {
                    $data['descript'] = trim($_POST['descript']);
                }

                $data['user_id'] = $_SESSION['user_id'];
                if($this->userModel->update_profile($data))
                {
                    $_SESSION['username'] = $data['fullname'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['birthday'] = $data['birthday'];
                    $_SESSION['phone'] = $data['phone'];
                    $_SESSION['address'] = $data['address'];
                    $_SESSION['descript'] = $data['descript'];
                    header('location: ' . URL_ROOT . '/users/profile');
                }
                else
                {
                    $updateError = "Invalid";
                }
            }

        }
        $data = [
            'title' => 'Update Profile',
            'user' => $user,
            'fullname' => $user->user_fullname,
            'email' => $user->user_email,
            'birthday' => $user->user_birthday,
            'phone' => $user->user_phone,
            'address' => $user->user_address,
            'descript' => $user->user_descript,
            'updateError' => $updateError
        ];
        $this->view('users/profile', $data);

    }
    
}