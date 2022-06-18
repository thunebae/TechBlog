<?php
    session_start();
?>
<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
        $this->cmtModel = $this->model('Cmt');
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        $posts = $this->postModel->getAllPosts();
        $popular_posts = $this->postModel->getPopularPosts();
        $fist_page_posts = $this->postModel->getFistPage();

        $posts_per_page = 6;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $index_post = ((int)$page - 1)*$posts_per_page;
        $page_view = $this->postModel->getPostsPerPage($index_post, $posts_per_page);
        

        $data = [
            'title' => 'Welcome to the index page',
            'users' => $users,
            'posts' => $posts,
            'fist_page_posts' => $fist_page_posts,
            'page_view' => $page_view,
            'page' => $page,
            'popular_posts' => $popular_posts
        ];
        $this->view('pages/index', $data);
    }

    //Them popular post
    public function post($id)
    {
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $post = $this->postModel->getBodyById($id);
        $author = $this ->userModel->getUserById($post->user_id);
        $cmts = $this->cmtModel->getCmtByPostId($id);
        $count_cmt = count($cmts);

        $popular_posts = $this->postModel->getPopularPosts();

        if (!($this->postModel->updateView($id))) {
            header('location: ' . URL_ROOT . '/pages/post/' . $id);
        }
        
        if (!$post){
            header('location: ' . URL_ROOT . '/pages');
        }else{
            $data = [
                'post' => $post,
                'author_username' => $author->user_name,
                'author_fullname' => $author->user_fullname,
                'author_descript' => $author->user_descript,
                'author_avatar' => $author->user_photo,
                'user' => $user,
                'cmts' => $cmts,
                'count_cmt' => $count_cmt,
                'popular_posts' => $popular_posts
            ];
        }
        $this->view('pages/post', $data);
    }

}