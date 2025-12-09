<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation 
 * @property CI_Session $session 
 * @property Project_model $Project_model 
 * @property CI_Input $input 
 * @property CI_Security $security
 * @property CI_URI $uri
 * @property CI_Pagination $pagination
 */

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
    }

    public function list($page = 0)
    {
        $this->load->library('pagination');

        $config = [
            'base_url'    => site_url('project/list'),
            'total_rows'  => $this->Project_model->count_projects(),
            'per_page'    => 10,
            'uri_segment' => 3,
            'full_tag_open' => '<ul class="pagination justify-content-center">',
            'full_tag_close' => '</ul>',
            'num_tag_open'  => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'cur_tag_open'  => '<li class="page-item active"><a class="page-link">',
            'cur_tag_close' => '</a></li>',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'attributes'    => ['class' => 'page-link']
        ];

        $this->pagination->initialize($config);

        $data['title'] = 'Project List | CRM';
        $data['projects'] = $this->Project_model->get_projects(10, $page);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('partials/header', $data);
        $this->load->view('partials/navbar');
        // $this->load->view('partials/sidebar');
        $this->load->view('project/list', $data);
        $this->load->view('partials/footer');
    }

    public function create()
    {
        $data['title'] = 'Create Project | CRM';
        $this->load->view('partials/header', $data);
        $this->load->view('partials/navbar');
        // $this->load->view('partials/sidebar');
        $this->load->view('project/create', $data);
        $this->load->view('partials/footer');
    }

    public function add()
    {
        if (!$this->input->is_ajax_request()) {
            show_error('No direct script access allowed', 403);
        }

        $this->form_validation->set_rules('project_name', 'Project Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|trim|xss_clean');
        $this->form_validation->set_rules('developer_name', 'Developer Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('project_manager', 'Project Manager', 'required|trim|xss_clean');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode([
                'success' => false,
                'message' => strip_tags(validation_errors()),
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ]);
            return;
        }
        // $token = bin2hex(random_bytes(16));
        $projectData = [
            'project_name'    => $this->input->post('project_name', TRUE),
            'description'     => $this->input->post('description', TRUE),
            'start_date'      => $this->input->post('start_date', TRUE),
            'status'          => $this->input->post('status', TRUE),
            'developer_name'  => $this->input->post('developer_name', TRUE),
            'helping_hand'    => $this->input->post('helping_hand', TRUE),
            'project_manager' => $this->input->post('project_manager', TRUE),
            'created_at'      => date('Y-m-d H:i:s')
        ];

        $inserted = $this->Project_model->insert_project($projectData);

        if ($inserted) {
            echo json_encode([
                'success' => true,
                'message' => 'Project created successfully!',
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'resetForm' => true
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create project. Please try again.',
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ]);
        }
    }

    public function view($id)
    {
        $data['project'] = $this->Project_model->get_project_by_id($id);

        if (!$data['project']) show_404();

        $data['title'] = 'View Project | CRM';
        $this->load->view('partials/header', $data);
        $this->load->view('partials/navbar');
        // $this->load->view('partials/sidebar');
        $this->load->view('project/view', $data);
        $this->load->view('partials/footer');
    }

    public function edit($id)
    {
        $data['project'] = $this->Project_model->get_project_by_id($id);

        if (!$data['project']) show_404();

        $data['title'] = 'Edit Project | CRM';

        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);

        $this->form_validation->set_rules('project_name', 'Project Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|trim|xss_clean');
        $this->form_validation->set_rules('developer_name', 'Developer Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('project_manager', 'Project Manager', 'required|trim|xss_clean');

        if ($this->input->method() === 'post') {

            if ($this->form_validation->run() === FALSE) {
                echo json_encode([
                    'status' => 'error',
                    'errors' => strip_tags(validation_errors()),
                    'csrfToken' => $this->security->get_csrf_hash()
                ]);
                return;
            }

            $updateData = [
                'project_name'    => $this->input->post('project_name', TRUE),
                'description'     => $this->input->post('description', TRUE),
                'start_date'      => $this->input->post('start_date', TRUE),
                'status'          => $this->input->post('status', TRUE),
                'developer_name'  => $this->input->post('developer_name', TRUE),
                'helping_hand'    => $this->input->post('helping_hand', TRUE),
                'project_manager' => $this->input->post('project_manager', TRUE),
            ];

            $this->Project_model->update_project($id, $updateData);

            echo json_encode([
                'status' => 'success',
                'message' => 'Project updated successfully!',
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash()
            ]);
            return;
        }

        $this->load->view('partials/header', $data);
        $this->load->view('partials/navbar');
        // $this->load->view('partials/sidebar');
        $this->load->view('project/edit', $data);
        $this->load->view('partials/footer');
    }
}
