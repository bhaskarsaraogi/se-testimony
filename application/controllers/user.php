<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged_in') == FALSE)
    {
      redirect('main/login', 'location');
    }
    $this->load->model('settings_model', 'settings');
    $this->load->model('user_model', 'user');
    $this->load->model('testimonial_model', 'testimonial');
    $this->session->set_userdata(array('admin_controls' => FALSE, 'site_name' => $this->settings->get_site_name()));
  }

  public function index()
  {
    redirect('user/dashboard', 'location');
  }

  public function dashboard()
  {
      $data['page_title'] = 'Dashboard';
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $data['testimonials'] = $this->testimonial->show_all_testimonials($user_id, 0);
      $user_details = $this->user->get_userdetails($user_name);
      $data['user_details'] = $user_details;
      if ($user_name == 'guest')
        $data['guest_account_flag'] = TRUE;
      else
        $data['guest_account_flag'] = FALSE;
      $this->load->view('user/dashboard', $data);
  }

  public function edit_profile()
  {
      $data['page_title'] = 'Edit Your Profile';
      $data['error'] = NULL;

      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');

      $user_name = $this->session->userdata('user_name');
      $this->load->model('user_model', 'user');
      $user_details = $this->user->get_userdetails($user_name);
      $data['id_number'] = $user_details->id_number;
      $data['fullName'] = $user_details->name;
      $data['nickName'] = $user_details->nick;
      if ($user_details->dob != NULL)
      {
        $dob = explode(' ', $user_details->dob);
        if ($dob[0] != NULL)
        {
          $data['date'] = $dob[0];
        }
        if ($dob[1] != NULL)
        {
          $data['month'] = $dob[1];
        }
        if ($dob[2] != NULL)
        {
          $data['year'] = $dob[2];
        }
      }
      else
      {
        $data['date'] = 1;
        $data['month'] = 'January';
        $data['year'] = 1991;
      }

      $data['hostel'] = $user_details->hostel;
      $data['roomno'] = $user_details->roomno;
      $data['address'] = $user_details->address;
      $data['contact'] = $user_details->contact;
      $data['email'] = $user_details->email;

      if ($this->form_validation->run('user/profile') == FALSE)
      {
        $this->load->view('user/edit_profile', $data);
      }
      else
      {
        $id_number = $this->input->post('id_number');
        $fullName = $this->input->post('fullName');
        $nickName = $this->input->post('nickName');
        $hostel = $this->input->post('hostel');
        $roomno = $this->input->post('roomno');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $email = $this->input->post('email');
        $dob = $this->input->post('date').' '.$this->input->post('month').' '.$this->input->post('year');
        if ($id_number)
          $arr_userdetails['id_number'] = $id_number;
        else
          $arr_userdetails['id_number'] = NULL;
        if ($fullName)
          $arr_userdetails['name'] = $fullName;
        else
          $arr_userdetails['name'] = NULL;
        if ($nickName)
          $arr_userdetails['nick'] = $nickName;
        else
          $arr_userdetails['nick'] = NULL;
        if ($dob)
          $arr_userdetails['dob'] = $dob;
        else
          $arr_userdetails['dob'] = NULL;
        if ($hostel)
          $arr_userdetails['hostel'] = $hostel;
        else
          $arr_userdetails['hostel'] = NULL;
        if ($roomno)
          $arr_userdetails['roomno'] = $roomno;
        else
          $arr_userdetails['roomno'] = NULL;
        if ($address)
          $arr_userdetails['address'] = $address;
        else
          $arr_userdetails['address'] = NULL;
        if ($contact)
          $arr_userdetails['contact'] = $contact;
        else
          $arr_userdetails['contact'] = NULL;
        if ($email)
          $arr_userdetails['email'] = $email;
        else
          $arr_userdetails['email'] = NULL;

        /*
         * Image Uploading
         */
        $upload_config['upload_path'] = './uploads/';
        $upload_config['allowed_types'] = 'gif|jpg|png';
        $upload_config['max_width'] = '1024';
        $upload_config['max_height'] = '768';
        $upload_config['file_name'] = $user_name;

        $this->load->library('upload', $upload_config);
        if (!$this->upload->do_upload('profile_image'))
        {
          $error = array('error' => $this->upload->display_errors());
        }
        else
        {
          $image_data = $this->upload->data();
          $arr_userdetails['image_name'] = $image_data['file_name'];
          $arr_userdetails['image_path'] = $image_data['file_path'];
          /*
           * Thumbnail Creation
           */
          $image_lib_config['image_library'] = 'gd2';
          $image_lib_config['create_thumb'] = TRUE;
          $image_lib_config['maintain_ratio'] = TRUE;
          $image_lib_config['width'] = 150;
          $image_lib_config['height'] = 150;
          $image_lib_config['source_image'] = $image_data['full_path'];

          $this->load->library('image_lib', $image_lib_config);

          $this->image_lib->resize();
          $arr_userdetails['image_thumb'] = $image_data['raw_name'].'_thumb'.$image_data['file_ext'];
        }

        $this->user->update_userdetails($user_name, $arr_userdetails);
        redirect('user', 'location');
      }
  }

  public function testimonials()
  {
      $data['page_title'] = 'Your Testimonials';
      $this->load->model('user_model', 'user');
      $this->load->model('testimonial_model', 'testimonial');
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $arr_testimonials['public'] = $this->testimonial->get_testimonials_for($user_id, 'public');
      $arr_testimonials['private'] = $this->testimonial->get_testimonials_for($user_id, 'private');
      $arr_testimonials['written_by_you'] = $this->testimonial->get_testimonials_by($user_id);
      $data['testimonials'] = $arr_testimonials;
      $this->load->view('user/your_testimonials', $data);
  }

  public function search() {
      $data['page_title'] = 'Search';
      $this->load->model('user_model', 'user');
      $search_query = $this->input->post('query');
      $search_results = $this->user->search_users($search_query);
      $data['search_results'] = $search_results;
      $data['search_query'] = $search_query;
      $this->load->view('user/search', $data);
  }

  public function profile($query)
  {
      $this->load->model('user_model', 'user');
      $this->load->model('testimonial_model', 'testimonial');
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      if ($query == 'me' || $query == $user_name)
      {
        $id = $user_id;
        $data['add_testimonial_flag'] = FALSE;
      }
      else
      {
        $id = $query;
        $data['to_id'] = $id;
        $data['add_testimonial_flag'] = TRUE;
      }
      $data['testimonials'] = $this->testimonial->get_testimonials_for($id);
      $user_details = $this->user->get_userdetails($id, 'id');
      if ($user_details)
      {
        $data['page_title'] = $user_details->name;
        $data['user_details'] = $user_details;
      }
      else
      {
        $data['page_title'] = 'User does not exist';
        $data['user_details'] = FALSE;
      }
      $this->load->view('user/profile', $data);
  }
/*
  public function verify($verification_key)
  {
    $this->load->model('user_model', 'user');
    $check_val = $this->user->verify_account($verification_key);
    if ($check_val)
    {
      $data['page_title'] = 'Account Verified';
      $this->load->view('messages/account_verified', $data);
    }
    else
    {
      $data['page_title'] = 'Account Verification Problem';
      $this->load->view('messages/account_verification_problem', $data);
    }
  }
*/

  public function change_password()
  {
      if ($this->form_validation->run('standard/change_password') == FALSE)
      {
        redirect('user/edit_profile', 'location');
      }
      else
      {
        $password = $this->input->post('password');
        $user_name = $this->session->userdata('user_name');
        $this->simpleloginsecure->new_password($user_name, $password);
        redirect('user/edit_profile', 'location');
      }
  }

  public function info()
  {
    $this->output->cache(3600);
    $data['page_title'] = 'Information';
    $this->load->view('standard/info', $data);
  }

  public function export()
  {
      $this->load->model('user_model', 'user');
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $this->user->export_user_data($user_id);
  }

  public function logout()
  {
      $this->simpleloginsecure->logout();
      /*
      $data['page_title'] = 'Logged Out';
      $data['type'] = 'main';
      $this->load->view('messages/logged-out', $data);
      */
      redirect('main/login', 'location');
  }

}