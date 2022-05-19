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

            // Get file form post
            $post_image = $_FILES['post_image'];
            $post_image_name = rand() ."_" . $post_image['name'];
            $post_image_tmp_name = $post_image['tmp_name'];
            $post_image_size = $post_image['size'];
            $post_image_error = $post_image['error'];
            $post_image_type = $post_image['type'];

            $post_image_ext = explode('.', $post_image_name);
            $post_image_ext = strtolower(end($post_image_ext));

            $allowed = array('jpg', 'jpeg', 'png');

            try 
            {
                $mime_type = $_FILES["post_image"]["type"];
                if (!in_array($mime_type, ["image/jpeg", "image/png", "image/gif"]))
                    die("Hack detected");
            
            } catch(Exception $e) {
                $error = $e->getMessage();
                die($error);
            } 

            if(in_array($post_image_ext, $allowed)) {
                if($post_image_error === 0) {
                    if($post_image_size <= 2097152) {
                        $post_image_destination = BLOG_ROOT . "\\uploads\\post\\" . $post_image_name;
                        move_uploaded_file($post_image_tmp_name, $post_image_destination);
                        $data['post_image'] = "..\\..\\app\\uploads\\post\\" . $post_image_name;
                    } else {
                        $data['bodyError'] = 'The image size is too big';
                    }
                } else {
                    $data['bodyError'] = 'There was an error uploading the image';
                }
            } else {
                $data['bodyError'] = 'The image type is not allowed';
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