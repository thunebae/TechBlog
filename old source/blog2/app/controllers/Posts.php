<?php
    require_once '../app/helpers/session_helper.php';
?>
<?php 
class Posts extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');

    }

    public function index()
    {
        $posts = $this->postModel->getAllPosts();
        $posts_of_user = $this->userModel->getPostsByUser($_SESSION['user_id']);
        $fist_page_posts = $this->userModel->getPostsByUserFirstPage($_SESSION['user_id']);

        $posts_per_page = 8;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $index_post = ((int)$page - 1)*$posts_per_page;
        $page_view = $this->userModel->getPostsByUserPerPage($_SESSION['user_id'], $index_post, $posts_per_page);

        $data = [
            'posts' => $posts,
            'posts_of_user' => $posts_of_user,
            'fist_page_posts' => $fist_page_posts,
            'page_view' => $page_view,
            'page' => $page
        ];
        $this->view('posts/index', $data);
    }


    //create post
    public function create()
    {
        if(!isLoggedIn()) {
            header("Location: " . URL_ROOT . "/posts");
        }

        $data = [
            'user_id' => $_SESSION['user_id'],
            'title' => '',
            'category' => '',
            'descript' => '',
            'body' => '',
            'titleError' => '',
            'categoryError' => '',
            'descriptError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'category' => trim($_POST['category']),
                'descript' => trim($_POST['descript']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];

            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if(empty($data['category'])) {
                $data['categoryError'] = 'The category of a post cannot be empty';
            }

            if(empty($data['descript'])) {
                $data['descriptError'] = 'The description of a post cannot be empty';
            }

            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if (empty($data['titleError']) && empty($data['categoryError']) && empty($data['descriptError']) && empty($data['bodyError'])) {
                if ($this->postModel->addPost($data)) {
                    header("Location: " . URL_ROOT . "/posts");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('posts/create', $data);
            }
        }

        $this->view('posts/create', $data);
    }

    // Update post
    public function update($id)
    {
        $post = $this->postModel->findPostById($id);
        if(!isLoggedIn() && $post->user_id != $_SESSION['user_id'])
        {
            header("Location: " . URL_ROOT . "/posts");
        }
        

        $data = [
            'post' => $post,
            'title' => '',
            'category' => '',
            'descript' => '',
            'body' => '',
            'titleError' => '',
            'categoryError' => '',
            'descriptError' => '',
            'bodyError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'category' => trim($_POST['category']),
                'descript' => trim($_POST['descript']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'bodyError' => ''
            ];

            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a post cannot be empty';
            }

            if(empty($data['category'])) {
                $data['categoryError'] = 'The category of a post cannot be empty';
            }

            if(empty($data['descript'])) {
                $data['descriptError'] = 'The description of a post cannot be empty';
            }

            if(empty($data['body'])) {
                $data['bodyError'] = 'The body of a post cannot be empty';
            }

            if (empty($data['titleError']) && empty($data['categoryError']) && empty($data['descriptError']) && empty($data['bodyError'])) {
                if ($this->postModel->updatePost($data)) {
                    header("Location: " . URL_ROOT . "/posts");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('posts/update', $data);
            }
        }

        $this->view('posts/update', $data);
    }

    // Delete post
    public function delete($id)
    {
        $post = $this->postModel->findPostById($id);
        if(!isLoggedIn() && $post->user_id != $_SESSION['user_id'])
        {
            header("Location: " . URL_ROOT . "/posts");
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->postModel->deletePost($id)) {
                header("Location: " . URL_ROOT . "/posts");
            } else {
                die("Something went wrong, please try again!");
            }
        }
    }
}