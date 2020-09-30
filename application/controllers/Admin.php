<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // check kalau TIDAK ADA session 
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->from('user');
        $data['count_all'] = $this->db->count_all_results();

        $this->db->where('is_active', 1);
        $this->db->from('user');
        $data['count_active'] = $this->db->count_all_results();

        $this->db->where('is_active', 0);
        $this->db->from('user');
        $data['count_inactive'] = $this->db->count_all_results();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    // menerima parameter
    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    // method ajax di footer untuk change access
    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        // select * from user_access_menu where role_id = $role_id, menu_id = $menu_id 
        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            // jika tidak ada, insert
            $this->db->insert('user_access_menu', $data);
        } else {
            // jika ada, hapus
            $this->db->delete('user_access_menu', $data);
        }


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed.
        </div>');
    }

    public function usermanagement()
    {
        $data['title'] = 'User Management';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************
        // ambil dari config pagination, buat senidri
        $this->load->library('pagination');

        // ambil data keyword

        if ($this->input->post('is_active')) {
            if ($this->input->post('is_active') == "Active") {
                $data['is_active'] = '1';
            } elseif ($this->input->post('is_active') == "Not Active") {
                $data['is_active'] = '0';
            } elseif ($this->input->post('is_active') == "All") {
                $data['is_active'] = NULL;
            }
            $this->session->set_userdata('is_active', $data['is_active']);
        } else {
            $data['is_active'] = $this->session->userdata('is_active');
        }
        if ($this->input->post('keyword')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        if ($this->input->post('role')) {
            if ($this->input->post('role') == "Vendor") {
                $data['role'] = '2';
            } elseif ($this->input->post('role') == "Member") {
                $data['role'] = '3';
            } elseif ($this->input->post('role') == "All") {
                $data['role'] = NULL;
            }
            $this->session->set_userdata('role', $data['role']);
        } else {
            $data['role'] = $this->session->userdata('role');
        }
        // var_dump($this->input->post('keyword'));
        // var_dump($this->input->post('is_active'));

        $config['base_url'] = 'http://localhost:84/project-soba/admin/usermanagement';
        if ($data['is_active']) {
            $this->db->where('is_active', $data['is_active']);
        }
        if ($data['is_active'] == '0') {
            $this->db->where('is_active', $data['is_active']);
        }
        if ($data['role']) {
            $this->db->where('role_id', $data['role']);
        }
        $this->db->like('name', $data['keyword']);
        $this->db->or_like('email', $data['keyword']);
        $this->db->from('user');
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        if ($data['is_active']) {
            $data['user_all'] = $this->db->where('is_active', $data['is_active']);
        }
        if ($data['is_active'] == '0') {
            $data['user_all'] = $this->db->where('is_active', $data['is_active']);
        }
        if ($data['role']) {
            $data['user_all'] = $this->db->where('role_id', $data['role']);
        }
        if ($data['keyword']) {
            $data['user_all'] = $this->db->like('name', $data['keyword']);
            $data['user_all'] = $this->db->or_like('email', $data['keyword']);
        }
        $this->db->order_by('date_created', 'DESC');
        $data['user_all'] = $this->db->get('user', $config['per_page'], $data['start'], $data['keyword'])->result_array();

        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************   

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/usermanagement', $data);
        $this->load->view('templates/footer');
    }

    public function resetlisting()
    {
        $this->session->unset_userdata('keyword');
        $this->session->unset_userdata('is_active');
        $this->session->unset_userdata('role');
        redirect('admin/usermanagement');
    }

    public function dropuser($user_id)
    {
        $user = $this->db->get_where('user', ['id' => $user_id])->row_array();
        $old_image = $user['image'];

        if ($old_image != 'default.png') {
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
        }
        if ($old_image != 'default.png') {
            unlink(FCPATH . 'assets/img/profile/thumbnail/' . $old_image);
        }


        $temp = $user['id'];
        $query = "SELECT `user_event`.*
                    FROM `user_event` JOIN `user_subscribe`
                      ON `user_event`.`id` = `user_subscribe`.`event_id`
                   WHERE `user_subscribe`.`id` = $temp                   
             ";
        $data['usersubscribe'] = $this->db->query($query)->result_array();
        foreach ($data['usersubscribe'] as $us) {
            $this->db->set('subscribed', --$us['subscribed']);
            $this->db->where('id', $us['id']);
            $this->db->update('user_event');
        };

        $this->db->delete('user', ['id' => $user_id]);
        $this->db->delete('user_subscribe', ['id' => $user_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
             This account has been deleted.
             </div>');
        redirect('admin/usermanagement');
    }

    public function detailuser($id)
    {
        $data['title'] = 'Detail User';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_detail'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailuser', $data);
        $this->load->view('templates/footer');
    }

    public function set_active($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($data['user']['is_active'] == 1) {
            $this->db->set('is_active', 0);
            $this->db->where('id', $data['user']['id']);
            $this->db->update('user');
        } elseif ($data['user']['is_active'] == 0) {
            $this->db->set('is_active', 1);
            $this->db->where('id', $data['user']['id']);
            $this->db->update('user');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
        ' . $data['user']['email'] . ' active has been changed.
        </div>');
        redirect('admin/usermanagement');
    }
}
