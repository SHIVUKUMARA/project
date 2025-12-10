<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_project($data)
    {
        return $this->db->insert('projects', $data);
    }

    public function get_projects($limit = 10, $offset = 0)
    {
        return $this->db->order_by('id')
            ->get('projects', $limit, $offset)
            ->result_array();
    }

    public function count_projects()
    {
        return $this->db->count_all('projects');
    }

    public function get_project_by_id($id)
    {
        return $this->db->get_where('projects', ['id' => $id])->row_array();
    }

    public function update_project($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('projects', $data);
    }

    public function delete_project($id)
    {
        return $this->db->delete('projects', ['id' => $id]);
    }
}

// CREATE TABLE projects (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     project_name VARCHAR(150) NOT NULL,
//     description TEXT NOT NULL,
//     start_date DATE NOT NULL,
//     status ENUM('Pending','Ongoing','Completed') DEFAULT 'Pending',
//     developer_name VARCHAR(100) NOT NULL,
//     helping_hand VARCHAR(100),
//     project_manager VARCHAR(100) NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP
// );