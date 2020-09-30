<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check kalau TIDAK ADA session 
        is_logged_in();

        if ($this->session->userdata('email')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            if ($data['user']['role_id'] == 3) {
                redirect('front');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        // JADI DI CEK, KALAU BELUM JALANIN FORM VALIDATION ( BUTTON SUBMIT DI CLICK )
        // MAKA FALSE DAN CUMA TAMPILIN VIEW AJA,
        // KALAU DI CLIKC JADI TRUE BARU JALANIN FUNGSI SEBENANRNYA
        // JADI SATU METHOD UNTUK 2 FUNGSI 
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // check jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    // hapus gambar lama*****************************************************************************
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        unlink(FCPATH . 'assets/img/profile/thumbnail/' . $old_image);
                    }
                    // hapus gambar lama*****************************************************************************

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->upload_image_user();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated.
            </div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Wrong current password.
                </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    New password can not be the same as current password.
                    </div>');
                    redirect('user/changepassword');
                } else {
                    // HASH PASSWORD DAN UPDATE PASSWORD
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password changed.
                    </div>');
                    redirect('user');
                }
            }
        }
    }

    public function eventmanagement()
    {
        $data['title'] = 'Event Management';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************
        // pagination start  ******************************************************************************

        // ambil dari config pagination, buat senidri
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost:84/project-soba/user/eventmanagement';

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
        if ($this->input->post('date_start')) {
            $data['date_start'] = $this->input->post('date_start');
            $data['date_end'] = $this->input->post('date_end');
            $this->session->set_userdata('date_start', $data['date_start']);
            $this->session->set_userdata('date_end', $data['date_end']);
        } else {
            $data['date_start'] = $this->session->userdata('date_start');
            $data['date_end'] = $this->session->userdata('date_end');
        }

        if ($data['is_active']) {
            $this->db->where('is_active', $data['is_active']);
        }
        if ($data['is_active'] == '0') {
            $this->db->where('is_active', $data['is_active']);
        }
        if ($data['date_start']) {
            $this->db->where('date_start >=', $data['date_start']);
            $this->db->where('date_end <=', $data['date_end']);
        }
        $this->db->where('user_id', $data['user']['id']);
        $this->db->from('user_event');
        $config['total_rows'] = $this->db->count_all_results();

        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        if ($data['is_active']) {
            $data['event'] = $this->db->where('is_active', $data['is_active']);
        }
        if ($data['is_active'] == '0') {
            $data['event'] = $this->db->where('is_active', $data['is_active']);
        }
        if ($data['date_start']) {
            $data['event'] = $this->db->where('user_id', $data['user']['id']);
            $data['event'] = $this->db->where('date_start >=', $data['date_start']);
            $data['event'] = $this->db->where('date_end <=', $data['date_end']);
        }
        $this->db->where('user_id', $data['user']['id']);
        $this->db->order_by('date_start', 'ASC');
        $data['event'] = $this->db->get('user_event', $config['per_page'], $data['start'])->result_array();

        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************   
        // pagination end      ******************************************************************************  

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/eventmanagement', $data);
        $this->load->view('templates/footer');
    }

    public function addevent()
    {
        $data['title'] = 'Event Management';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['event'] = $this->db->get('user_event')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('date_start', 'Date End', 'required|trim');
        $this->form_validation->set_rules('date_end', 'Date End', 'required|trim');
        $this->form_validation->set_rules('venue', 'venue', 'required|trim');
        $this->form_validation->set_rules('htm', 'HTM', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required');

        // false -> jika data tdk sesuai rules
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/addevent', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $date_start = $this->input->post('date_start');
            $date_end = $this->input->post('date_end');
            $venue = $this->input->post('venue');
            $htm = $this->input->post('htm');
            $description = $this->input->post('description');

            // check jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/event/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'user_id' => $data['user']['id'],
                'user_name' => $data['user']['name'],
                'name' => htmlspecialchars($this->input->post('name', true)),
                'date_start' => $date_start,
                'date_end' => $date_end,
                'venue' => $venue,
                'htm' => $htm,
                'description' => $description,
                'image' => $new_image,
                'date_created' => time(),
                'is_active' => 1,
            ];


            $this->db->insert('user_event', $data);

            $this->upload_image();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your event has been added.
            </div>');
            redirect('user/eventmanagement');
        }
    }

    public function editevent($event_id)
    {
        $data['title'] = 'Edit Management';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['event'] = $this->db->get_where('user_event', ['id' => $event_id])->row_array();


        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('date_start', 'Date End', 'required|trim');
        $this->form_validation->set_rules('date_end', 'Date End', 'required|trim');
        $this->form_validation->set_rules('venue', 'venue', 'required|trim');
        $this->form_validation->set_rules('htm', 'HTM', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/editevent', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $date_start = $this->input->post('date_start');
            $date_end = $this->input->post('date_end');
            $venue = $this->input->post('venue');
            $htm = $this->input->post('htm');
            $description = $this->input->post('description');

            // check jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/event/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    // hapus gambar lama*****************************************************************************
                    $old_image = $data['event']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/event/' . $old_image);
                        unlink(FCPATH . 'assets/img/event/thumbnail/' . $old_image);
                    }
                    // hapus gambar lama*****************************************************************************

                    if ($this->upload->data('file_name')) {
                        $new_image = $this->upload->data('file_name');
                        $this->upload_image();
                        $this->db->set('image', $new_image);
                    }
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('date_start', $date_start);
            $this->db->set('date_end', $date_end);
            $this->db->set('venue', $venue);
            $this->db->set('htm', $htm);
            $this->db->set('description', $description);
            $this->db->where('id', $event_id);
            $this->db->update('user_event');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Your event has been updated.
             </div>');
            redirect('user/eventmanagement');
        }
    }

    public function dropevent($event_id)
    {
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $event = $this->db->get_where('user_event', ['id' => $event_id])->row_array();
        $old_image = $event['image'];

        unlink(FCPATH . 'assets/img/event/' . $old_image);
        unlink(FCPATH . 'assets/img/event/thumbnail/' . $old_image);
        $this->db->delete('user_event', ['id' => $event_id]);
        $this->db->delete('user_subscribe', ['event_id' => $event_id, 'vendor_id' => $data['user']['id']]);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
             Your event has been deleted.
             </div>');
        redirect('user/eventmanagement');
    }

    public function detailevent($event_id)
    {
        // ambil data user dari database berdasarkan email dari session
        $data['title'] = "Detail Event";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['event'] = $this->db->get_where('user_event', ['id' => $event_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detailevent', $data);
        $this->load->view('templates/footer');
    }

    public function resetlisting()
    {
        $this->session->unset_userdata('date_start');
        $this->session->unset_userdata('date_end');
        $this->session->unset_userdata('is_active');
        redirect('user/eventmanagement');
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->where('user_id', $data['user']['id']);
        $this->db->from('user_event');
        $event = $this->db->get()->result_array();

        $data['subscribed'] = 0;
        foreach ($event as $e) {
            $data['subscribed'] =  $data['subscribed'] + $e['subscribed'];
        }

        $this->db->where('user_id', $data['user']['id']);
        $this->db->from('user_event');
        $data['count_event'] = $this->db->count_all_results();

        $this->db->where('user_id', $data['user']['id']);
        $this->db->where('is_active', 1);
        $this->db->from('user_event');
        $data['count_event_active'] = $this->db->count_all_results();

        $this->db->where('user_id', $data['user']['id']);
        $this->db->where('is_active', 0);
        $this->db->from('user_event');
        $data['count_event_not_active'] = $this->db->count_all_results();

        $data['broadcast'] = $this->db->get_where('user_broadcast', ['date_created' => date('Y-m-d', time())])->row_array();


        if (!$data['broadcast']) {
            $data['broadcast']['count'] = 0;
            // send pesan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            You have not broadcasted today.
            </div>');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/footer');
    }


    public function broadcastevent()
    {
        $data['title'] = 'Broadcast Event';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user_id = $data['user']['id'];

        // **********************************************
        // **********************************************
        // **********************************************
        $query = "SELECT * FROM `user_broadcast` WHERE vendor_id = $user_id ORDER BY date_created DESC LIMIT 1";
        $daterow = $this->db->query($query)->row_array();
        $startdate = strtotime($daterow['date_created']);
        $startdatemonth = date("Y-m-d", strtotime("+1 month", $startdate));
        var_dump($startdatemonth);

        $dateplus = $startdatemonth;

        $enddate = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "+1 month"));
        var_dump($enddate);
        echo "********************<br>";
        $count = 0;
        while ($dateplus != $enddate) {
            $dateplus = date('Y-m-d', strtotime("+1 day", strtotime($dateplus)));
            var_dump($dateplus);
            $count = $count + 1;
        }
        echo "********************<br>";
        var_dump($count);
        die;
        // **********************************************
        // **********************************************
        // **********************************************



        $data['broadcast'] = $this->db->get_where('user_broadcast', ['date_created' => date('Y-m-d', time()), 'vendor_id' => $data['user']['id']])->row_array();

        if ($data['broadcast']) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            You have broadcast today.
            </div>');
            redirect('user/dashboard');
        }

        $datemonth = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "+1 month"));

        $temp = $data['user']['id'];
        $query = "SELECT `user`.`email` , `user_event`.*
                    FROM `user_subscribe` JOIN `user_event`
                      ON `user_subscribe`.`event_id` = `user_event`.`id`
                                          JOIN  `user`
                      ON  `user_subscribe`.`id` = `user`.`id`    
                   WHERE `user_subscribe`.`vendor_id` = '$temp' AND `user_event`.`date_start` = '$datemonth'               
        ";

        $data['broad'] = $this->db->query($query)->result_array();

        // SEND EMAIL *****************************************************************************************
        // SEND EMAIL *****************************************************************************************
        // SEND EMAIL *****************************************************************************************
        // SEND EMAIL *****************************************************************************************
        // SEND EMAIL *****************************************************************************************            

        $i = 0;
        foreach ($data['broad'] as $br) {
            $token = base64_encode(random_bytes(24));
            $this->_sendEmail($token, 'broadcast', $br);
            $i++;
        }

        $data = [
            'date_created' => date('Y-m-d', time()),
            'vendor_id' => $data['user']['id'],
            'count' => $i,
        ];
        $this->db->insert('user_broadcast', $data);

        // send pesan
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Event has been successfully broadcasted.
        </div>');
        redirect('user/dashboard');
    }

    private function _sendEmail($token, $type, $br)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'soberkid0@gmail.com',
            'smtp_pass' => 'SatriaMega14',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        // manggil library email
        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('soberkid0@gmail.com', 'Satria Megaartha');
        $this->email->to($br['email']);

        if ($type == 'broadcast') {
            $this->email->subject('Event Broadcast');
            $this->email->message('Dont miss it !!<br><br><strong>' . $br['name'] . '</strong> by ' . $br['user_name'] . ' on ' . date('d F Y', strtotime($br['date_start'])) . ' - ' . date('d F Y', strtotime($br['date_end'])) . ' <br> ' . '<a href="' . base_url() . 'front/detailevent/' . $br['id'] . '"> Click Here for Details </a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        };
    }

    // END SEND EMAIL *************************************************************************************************
    // END SEND EMAIL *************************************************************************************************
    // END SEND EMAIL *************************************************************************************************
    // END SEND EMAIL *************************************************************************************************
    // END SEND EMAIL *************************************************************************************************

    public function upload_image()
    {
        $config['upload_path'] = './assets/img/event/thumbnail/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan        

        $this->upload->initialize($config);

        if (!empty($_FILES['image']['name'])) {

            if ($this->upload->do_upload('image')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/event/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 350;
                $config['height'] = 505;
                $config['new_image'] = './assets/img/event/thumbnail/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
        } else {
            //            
        }
    }

    public function upload_image_user()
    {
        $config['upload_path'] = './assets/img/profile/thumbnail/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan        

        $this->upload->initialize($config);

        if (!empty($_FILES['image']['name'])) {

            if ($this->upload->do_upload('image')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/profile/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 350;
                $config['height'] = 350;
                $config['new_image'] = './assets/img/profile/thumbnail/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
        } else {
            //            
        }
    }
}
