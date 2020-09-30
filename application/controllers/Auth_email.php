<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Login Page';
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer', $data);
        } else {
            // validasi success, ambil method private lain
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // SELECT * FROM TABLE USER WHERE EMAIL = $EMAIL
        // row_array = hasil query nya satu baris
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // user ada
        if ($user != null) {
            // user aktif
            if ($user['is_active'] == 1) {
                // cek password yg sdh di hash
                if (password_verify($password, $user['password'])) {
                    // kirim data ke halaman selanjutnya
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);

                    // cek status role id                
                    switch ($user['role_id']) {
                        case 3:
                            redirect('front');
                            break;
                        case 1:
                            redirect('admin/index');
                            break;
                        case 2:
                            redirect('user/dashboard');
                            break;
                        default:
                            redirect('front/index');
                    }
                    // if ($user['role_id'] == 1) {
                    //     redirect('admin/index');
                    // } elseif ($user['role_id'] == 2) {
                    //     redirect('user/dashboard');
                    // } elseif ($user['role_id'] == 3) {
                    //     redirect('front/index');
                    // } else {
                    //     redirect('front/index');
                    // }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Wrong password.
                    </div>');
                    redirect('auth/index');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                This account has not been activated.
                </div>');
                redirect('auth/index');
            }
        } else {
            // user tdk ada
            // send pesan
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Email is not registered.
            </div>');
            redirect('auth/index');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $data['user_role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email has already registered.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match.',
            'min_length' => 'Password too short.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        // false -> jika data tdk sesuai rules
        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('user_role'),
                'is_active' => 0,
                'date_created' => time(),
                'address' =>  htmlspecialchars($this->input->post('address', true))
            ];
            $role = $this->input->post('user_role');

            // SEND EMAIL *****************************************************************************************
            // SEND EMAIL *****************************************************************************************
            // SEND EMAIL *****************************************************************************************
            // SEND EMAIL *****************************************************************************************
            // SEND EMAIL *****************************************************************************************            

            // Buat token untuk dikirim ke email, sebaga pembandng dengan data database
            // random_bytes(24) -> gak tau kenapa, tapi harusnya 32, tapi kalo pake 32 hasilna jadi kelebihan
            $token = base64_encode(random_bytes(24));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            // insert database
            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            // masuk ke method _sendEmail()
            $this->_sendEmail($token, 'verify', $role);

            // send pesan
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your account has been created. Please activate your account.
            </div>');
            redirect('auth/index');
        }
    }

    private function _sendEmail($token, $type, $role)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'soberkid0@gmail.com',
            'smtp_pass' => 'SatriaMega14',
            'smtp_port' => 465,
            // 'mailtype'  => 'html',
            // 'charset'   => 'utf-8',
            'charset'   => 'iso-8859-1'
        ];

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");

        // manggil library email
        // $this->load->library('email', $config);
        // $this->email->initialize($config);

        $this->email->from('soberkid0@gmail.com', 'Carpe Diem');
        $this->email->to($this->input->post('email', true));

        if ($role == 3) {
            if ($type == 'verify') {
                $this->email->subject('Account Verification');

                $this->email->attach(base_url('assets_front/img/core-img/logoemail.png'), 'inline');
                $message = '
                <table border="0">
                    <tr>
                        <th>Click this link to verify your account</th>
                        <td>
                            <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">
                            Activate
                            </a>
                        </td>
                    </tr>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <tr>
                        <th rowspan="3" align="right">
                            <img src="cid:' . $this->email->attachment_cid(base_url('assets_front/img/core-img/logoemail.png')) . '" border="0">
                        </th>
                        <td>Copyright ©2019 All rights reserved</td>
                    </tr>
                    <tr>
                        <td>Denpasar, Bali</td>
                    </tr>
                    <tr>
                        <td>Contact Person : +62 83114377935</td>
                    </tr>
                </table>
                ';
                $this->email->message($message);
            }
        } elseif ($role == 2) {
            if ($type == 'verify') {
                $this->email->subject('Account Verification');
                // $this->email->message('Please contact administrator to activate this account <br> Contact Person : +6283114377935');

                $this->email->attach(base_url('assets_front/img/core-img/logoemail.png'), 'inline');
                $message = '
                <table border="0">
                    <tr>
                        <td>Please contact administrator to activate this account : </td>
                        <th align="left">+62 83114377935</th>
                    </tr>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <tr>
                        <th rowspan="3" align="right">
                            <img src="cid:' . $this->email->attachment_cid(base_url('assets_front/img/core-img/logoemail.png')) . '" border="0">
                        </th>
                        <td>Copyright ©2019 All rights reserved</td>
                    </tr>
                    <tr>
                        <td>Denpasar, Bali</td>
                    </tr>
                    <tr>
                        <td>Contact Person : +62 83114377935</td>
                    </tr>
                </table>
                ';
                $this->email->message($message);
            }
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


    // method ditarik dari url hasil send email
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                // pakai detik
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    // send pesan
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                     Account activation success. Please Login.
                     </div>');
                    redirect('auth/index');
                } else {
                    // hapus user dn token
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    // send pesan
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Account activation failed. Token expired.
                    </div>');
                    redirect('auth/index');
                }
            } else {
                // send pesan
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Account activation failed. Token invalid.
                </div>');
                redirect('auth/index');
            }
        } else {
            // send pesan
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Account activation failed. Wrong email.
            </div>');
            redirect('auth/index');
        }
    }

    public function logout()
    {
        $role_id = $this->session->userdata('role_id');

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        if ($role_id == 3) {
            redirect('front');
        } else {
            // send pesan
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out.
            </div>');
            redirect('auth/index');
        }
    }

    public function blocked()
    {
        $data['title'] = 'Blocked';
        // ambil data user dari database berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/footer');
    }

    public function forgotPassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot_password', $data);
            $this->load->view('templates/auth_footer', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(24));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot', $data['user']['role']);
                // send pesan
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Please check your email to reset your password.
                </div>');
                redirect('auth/forgotpassword');
            } else {
                // send pesan
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Email is not registered or activated.
                </div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token =  $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                // send pesan
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Reset password failed. Token invalid.
                </div>');
                redirect('auth');
            }
        } else {
            // send pesan
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Reset password failed. Wrong email.
            </div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        };

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match.',
            'min_length' => 'Password too short.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change_password', $data);
            $this->load->view('templates/auth_footer', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            // send pesan
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Password has been changed. Please Login.
             </div>');
            redirect('auth');
        }
    }
}
