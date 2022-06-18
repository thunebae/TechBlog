<?php
    // Path: app\controllers\Pages.php
    // Load the model and view
    class Controller
    {
        public function model($model)
        {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }

        // Call the view with data
        public function view($view, $data = [])
        {
            if (file_exists('../app/views/' . $view . '.php'))
            {
                require_once '../app/views/' . $view . '.php';
            }
            else
            {
                die('View does not exist');
            }
        }




    }