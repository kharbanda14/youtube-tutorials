<?php

class Post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
    }

    public function index( $slug )
    {

        $data = [];

        $post = $this->post_model->get_where(['slug' => $slug]);

        if (empty($post)) {
            show_404();
        }

        $data['post'] = $post;

        $this->load->view('partials/header', ['title' => $post->title]);
        $this->load->view('pages/view', $data);
        $this->load->view('partials/footer');
    }
}
