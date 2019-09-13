<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
    }

    public function index()
    {

        $data = [];

        $data['posts'] = $this->post_model->all();

        $this->load->view('partials/header', ['title' => 'Posts']);
        $this->load->view('pages/posts', $data);
        $this->load->view('partials/footer');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->create_post();
        }

        $this->load->view('partials/header', ['title' => 'Dashboard']);
        $this->load->view('pages/dashboard');
        $this->load->view('partials/footer');
    }

    public function delete($id)
    {
        $res = $this->post_model->delete_post($id);
        if ($res) {
            $this->session->set_flashdata('success', 'Post Deleted!');
        }
        return redirect(site_url('dashboard'));
    }

    public function edit($id)
    {
        if (!$id) {
            show_404();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->edit_post($id);
        }

        $data = [];

        $post = $this->post_model->get_post($id);

        if (empty($post)) {
            show_404();
        }

        $data['post'] = $post;

        $this->load->view('partials/header', ['title' => 'Dashboard']);
        $this->load->view('pages/dashboard', $data);
        $this->load->view('partials/footer');
    }

    private function create_post()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run()) {

            $postTitle = $this->input->post('title', true);

            $data = [
                'title' => $postTitle,
                'slug' => url_title($postTitle, '-', true),
                'content' => $this->input->post('content', true)
            ];

            $post_id = $this->post_model->create_post($data);
            $this->session->set_flashdata('success', 'Post Created!');
            redirect(site_url(['dashboard/edit', $post_id]));
        }
    }

    private function edit_post($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run()) {

            $postTitle = $this->input->post('title', true);

            $data = [
                'title' => $postTitle,
                'content' => $this->input->post('content', true)
            ];

            $this->post_model->update_post($id, $data);

            $this->session->set_flashdata('success', 'Post Updated!');
        }
    }
}
