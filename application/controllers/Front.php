<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check kalau TIDAK ADA session 
        if ($this->session->userdata('email')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            if ($data['user']['role_id'] == 2) {
                redirect('user');
            }
        }
    }

    public function Index()
    {
        // set is_active event
        // $this->_eventactive();


        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['vendor_list'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $data['usersubscribe'] = $this->db->get_where('user_subscribe', [
            'id' => $data['user']['id'],
        ])->result_array();
        $query = "SELECT `id`, `user_name`, `name`, `date_start`, `date_end` FROM `user_event` WHERE is_active = 1 ORDER BY date_start ASC LIMIT 3";
        $data['event_top'] = $this->db->query($query)->result_array();

        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************

        // ambil dari config pagination, buat senidri
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost:84/project-soba/front/index';

        // ambil data keyword        
        if ($this->input->post('vendor')) {
            $data['vendor'] = $this->input->post('vendor');
            $this->session->set_userdata('vendor', $data['vendor']);
        } else {
            $data['vendor'] = $this->session->userdata('vendor');
        }
        if ($this->input->post('date_start')) {
            $data['date_start'] = $this->input->post('date_start');
            $data['date_end'] = $this->input->post('date_end');
            $this->session->set_userdata('date_start', $data['date_start']);
            $this->session->set_userdata('date_end', $data['date_end']);
        } else {
            $data['date_start'] = $this->session->userdata('date_start');
            $data['date_end'] = $this->session->userdata('date_end');
        }


        if ($data['vendor']) {
            $this->db->where('user_id', $data['vendor']);
        }
        if ($data['date_start']) {
            $this->db->where('date_start >=', $data['date_start']);
            $this->db->where('date_end <=', $data['date_end']);
        }
        $this->db->where('is_active', 1);
        $this->db->from('user_event');
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 6;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        if ($data['date_start']) {
            $data['event'] = $this->db->where('date_start >=', $data['date_start']);
            $data['event'] = $this->db->where('date_end <=', $data['date_end']);
        }

        if ($data['vendor']) {
            $data['event'] = $this->db->where('user_id', $data['vendor']);
        }
        $this->db->where('is_active', 1);
        // $this->db->order_by('date_start', 'ASC');
        $this->db->order_by('subscribed', 'DESC');
        $data['event'] = $this->db->get('user_event', $config['per_page'], $data['start'])->result_array();
        $data['vendor_list_select'] = $this->db->get_where('user', ['role_id' => 2, 'id' => $data['vendor']])->row_array();
        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************  

        $this->load->view('front_templates/header', $data);
        $this->load->view('front/index', $data);
        $this->load->view('front_templates/footer', $data);
    }

    public function _eventactive()
    {
        $date = date("Y-m-d");
        $data['event'] = $this->db->where('date_end <', $date);
        $data['event'] = $this->db->get('user_event')->result_array();

        foreach ($data['event'] as $e) {
            $this->db->set('is_active', 0);
            $this->db->where('id', $e['id']);
            $this->db->update('user_event');
        }
    }

    public function resetlisting()
    {
        $this->session->unset_userdata('vendor');
        $this->session->unset_userdata('date_start');
        $this->session->unset_userdata('date_end');
        $this->session->unset_userdata('is_active');
        redirect('front');
    }

    public function resetlistingsubs()
    {
        $this->session->unset_userdata('is_active');
        redirect('front/subscribemanagement');
    }

    public function detailevent($event_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['detailevent'] = $this->db->get_where('user_event', ['id' => $event_id])->row_array();
        $data['usersubscribe'] = $this->db->get_where('user_subscribe', [
            'id' => $data['user']['id'],
        ])->result_array();

        $query = "SELECT `id`, `user_name`, `name`, `date_start`, `date_end` FROM `user_event` WHERE is_active = 1 ORDER BY date_start ASC LIMIT 3";
        $data['event_top'] = $this->db->query($query)->result_array();

        $this->load->view('front_templates/header', $data);
        $this->load->view('front/detail_event', $data);
        $this->load->view('front_templates/footer', $data);
    }

    public function usersubscribe($vendor_id, $event_id)
    {
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Your are not logged in.
            </div>');
            redirect('auth/index');
        }

        $query = "SELECT `id`, `user_name`, `name`, `date_start`, `date_end` FROM `user_event` WHERE is_active = 1 ORDER BY date_start ASC LIMIT 3";
        $data['event_top'] = $this->db->query($query)->result_array();

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $event = $this->db->get_where('user_event', ['id' => $event_id])->row_array();
        $user_id = $data['user']['id'];

        $usersubscribe = $this->db->get_where('user_subscribe', [
            'id' => $user_id,
            'vendor_id' => $vendor_id,
            'event_id' => $event_id
        ])->row_array();
        if ($usersubscribe) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Your already subscribe this event.
            </div>');
            redirect('front/detailevent/' . $event_id);
        } else {
            $data = [
                'id' => $user_id,
                'vendor_id' => $vendor_id,
                'event_id' => $event_id
            ];

            $this->db->insert('user_subscribe', $data);

            $this->db->set('subscribed', ++$event['subscribed']);
            $this->db->where('id', $event_id);
            $this->db->update('user_event');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your has been subscribed this event.
            </div>');
            redirect('front/detailevent/' . $event_id);
        }
    }

    public function subscribemanagement()
    {
        $this->load->library('form_validation');
        // check kalau TIDAK ADA session 
        is_logged_in();

        $query = "SELECT `id`, `user_name`, `name`, `date_start`, `date_end` FROM `user_event` WHERE is_active = 1 ORDER BY date_start ASC LIMIT 3";
        $data['event_top'] = $this->db->query($query)->result_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // ambil data keyword        
        if ($this->input->post('is_active')) {
            if ($this->input->post('is_active') == "Active") {
                $is_active = '1';
            } elseif ($this->input->post('is_active') == "Not Active") {
                $is_active = '0';
            } elseif ($this->input->post('is_active') == "All") {
                $is_active = NULL;
            }
            $this->session->set_userdata('is_active', $is_active);
        } else {
            $is_active = $this->session->userdata('is_active');
        }

        $temp = $data['user']['id'];
        if ($is_active) {
            $query = "SELECT `user_event`.*
                    FROM `user_event` JOIN `user_subscribe`
                      ON `user_event`.`id` = `user_subscribe`.`event_id`
                   WHERE `user_subscribe`.`id` = $temp AND `user_event`.`is_active` = '$is_active'
                   ORDER BY `date_start` ASC
             ";
        } elseif ($is_active == "0") {
            $query = "SELECT `user_event`.*
                    FROM `user_event` JOIN `user_subscribe`
                      ON `user_event`.`id` = `user_subscribe`.`event_id`
                   WHERE `user_subscribe`.`id` = $temp AND `user_event`.`is_active` = '$is_active'
                   ORDER BY `date_start` ASC
             ";
        } else {
            $query = "SELECT `user_event`.*
                    FROM `user_event` JOIN `user_subscribe`
                      ON `user_event`.`id` = `user_subscribe`.`event_id`
                   WHERE `user_subscribe`.`id` = $temp 
                   ORDER BY `date_start` ASC
             ";
        }

        $data['usersubscribe'] = $this->db->query($query)->result_array();

        $this->load->view('front_templates/header', $data);
        $this->load->view('front/subscribemanagement', $data);
        $this->load->view('front_templates/footer', $data);
    }

    public function unsubscribe($event_id, $vendor_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $event = $this->db->get_where('user_event', ['id' => $event_id])->row_array();

        $usersubscribe = $this->db->get_where('user_subscribe', [
            'id' => $data['user']['id'],
            'vendor_id' => $vendor_id,
            'event_id' => $event_id
        ])->row_array();
        if ($usersubscribe) {
            $this->db->delete('user_subscribe', ['id' => $data['user']['id'], 'event_id' => $event_id]);
            $this->db->set('subscribed', --$event['subscribed']);
            $this->db->where('id', $event_id);
            $this->db->update('user_event');

            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
             You unsubscribe this event.
             </div>');
            redirect('front/detailevent/' . $event_id);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
             You have not subscribe to this event.
             </div>');
            redirect('front/detailevent/' . $event_id);
        }
    }

    public function vendorcard()
    {
        $query = "SELECT `id`, `user_name`, `name`, `date_start`, `date_end` FROM `user_event` WHERE is_active = 1 ORDER BY date_start ASC LIMIT 3";
        $data['event_top'] = $this->db->query($query)->result_array();

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************

        // ambil dari config pagination, buat senidri
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost:84/project-soba/front/vendorcard';


        $this->db->where('is_active', 1);
        $this->db->where('role_id', 2);
        $this->db->from('user');
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 6;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        $this->db->where('is_active', 1);
        $this->db->where('role_id', 2);
        $this->db->order_by('date_created', 'ASC');
        $data['vendor'] = $this->db->get('user', $config['per_page'], $data['start'])->result_array();
        // $data['vendor'] = $this->db->get_where('user', $config['per_page'], $data['start'])->result_array();

        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************  

        $this->load->view('front_templates/header', $data);
        $this->load->view('front/vendorcard', $data);
        $this->load->view('front_templates/footer', $data);
    }

    public function vendorevent($vendor_id)
    {
        $this->session->set_userdata('vendor', $vendor_id);

        $query = "SELECT `id`, `user_name`, `name`, `date_start`, `date_end` FROM `user_event` WHERE is_active = 1 ORDER BY date_start ASC LIMIT 3";
        $data['event_top'] = $this->db->query($query)->result_array();

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['vendor_list'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $data['usersubscribe'] = $this->db->get_where('user_subscribe', [
            'id' => $data['user']['id'],
        ])->result_array();

        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************

        // ambil dari config pagination, buat senidri
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost:84/project-soba/front/vendorevent/' . $vendor_id;

        // ambil data keyword        
        if ($this->input->post('vendor')) {
            $data['vendor'] = $this->input->post('vendor');
            $this->session->set_userdata('vendor', $data['vendor']);
        } else {
            $data['vendor'] = $this->session->userdata('vendor');
        }
        if ($this->input->post('date_start')) {
            $data['date_start'] = $this->input->post('date_start');
            $data['date_end'] = $this->input->post('date_end');
            $this->session->set_userdata('date_start', $data['date_start']);
            $this->session->set_userdata('date_end', $data['date_end']);
        } else {
            $data['date_start'] = $this->session->userdata('date_start');
            $data['date_end'] = $this->session->userdata('date_end');
        }


        if ($data['vendor']) {
            $this->db->where('user_id', $data['vendor']);
        }
        if ($data['date_start']) {
            $this->db->where('date_start >=', $data['date_start']);
            $this->db->where('date_end <=', $data['date_end']);
        }
        $this->db->from('user_event');
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 6;
        // setting pagination dgn parameter
        if ($this->uri->segment(4) == '') {
            $config['uri_segment'] = 2;
        } else {
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
        }
        // END setting pagination dgn parameter
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);

        if ($data['date_start']) {
            $data['event'] = $this->db->where('date_start >=', $data['date_start']);
            $data['event'] = $this->db->where('date_end <=', $data['date_end']);
        }

        if ($data['vendor']) {
            $data['event'] = $this->db->where('user_id', $data['vendor']);
        }
        $data['event'] = $this->db->where('is_active', 1);
        // $this->db->order_by('date_start', 'ASC');        
        $this->db->order_by('subscribed', 'DESC');
        $data['event'] = $this->db->get('user_event', $config['per_page'], $data['start'])->result_array();
        $data['vendor_list_select'] = $this->db->get_where('user', ['role_id' => 2, 'id' => $data['vendor']])->row_array();
        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************  

        $this->load->view('front_templates/header', $data);
        $this->load->view('front/vendor_event', $data);
        $this->load->view('front_templates/footer', $data);
    }
}
