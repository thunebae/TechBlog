<?php
    require_once '../app/helpers/session_helper.php';
?>
<?php
class Cmts extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
        $this->cmtModel = $this->model('Cmt');
    }
    // index
    public function index()
    {
        $cmts = $this->cmtModel->getCmtByUserId($_SESSION['user_id']);
        $data = [
            'cmts' => $cmts
        ];
        $this->view('cmts/index', $data);
    }

    // create cmt
    public function create($id)
    {
        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . 'pages/post/'. $id);
        }

        $user = $this->userModel->getUserById($_SESSION['user_id']);
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'author' => $_SESSION['username'],
                'author_photo' => $user->user_photo,
                'post_id' => $id,
                'body' => trim($_POST['body']),
                'bodyError' => '',
            ];

            if(empty($data['body'])) {
                $data['bodyError'] = 'Please enter comment';
            }

            if(empty($data['bodyError'])) {
                if($this->cmtModel->createCmt($data)) {
                    header('location: ' . URL_ROOT . '/pages/post/' . $id);
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('pages/post/'. $id, $data);
            }
        }
    }


}