<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        $posts = $this->postModel->getAllPosts();
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
            'page' => $page
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $this->view('pages/about');
    }

}