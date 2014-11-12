<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    //Loads all the required models
    $this->load->model('settings_model', 'settings');
    $this->load->model('user_model', 'user');
    $this->load->model('testimonial_model', 'testimonial');
    //Set site data
    $this->session->set_userdata(array('admin_controls' => FALSE, 'site_name' => $this->settings->get_site_name()));
    //If logged in redirects to user dashbard
    if ($this->session->userdata('logged_in'))
    {
      redirect('user', 'location');
    }
  }

  public function index()
  {
    $data['page_title'] = 'Home';
    $data['testimonial_count'] = $this->testimonial->count_published();
    $data['user_count'] = $this->user->count_users();
    $this->load->view('standard/main', $data);
  }

  public function login()
  {
      $data['page_title'] = 'Login';
      $data['error'] = NULL;

      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');
      //Validation & not authentication
      if ($this->form_validation->run('standard/login') == FALSE)
      {
        $this->load->view('standard/login', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');

        $check_val = $this->simpleloginsecure->login($user_name, $password);

        $data['check_val'] = $check_val;

        if (!$check_val)
        {
          $data['error'] = 'Incorrect username or password. Please try again.';
          $this->session->set_userdata(array('logged_in' => FALSE));
          $this->load->view('standard/login', $data);
        }
        else
        {
          redirect('user', 'location');
        }
    }
  }

  public function register()
  {
      $data['page_title'] = 'Register';
      $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
      $data['error'] = NULL;
      if ($this->form_validation->run('standard/signup') == FALSE) //validate registration data
      {
        $this->load->view('standard/register', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');

        $this->load->model('user_model', 'user');

      //check if user_name already registered.
        $check_val = $this->user->check_user_name_exists($user_name);

        if($check_val)
        {
         $data['error'] = "This username is already registered with us.";
         $this->output->cache(5);
         $this->load->view('standard/register', $data);
        }

       else // proceed with registration
       {
         $registration_val = $this->simpleloginsecure->create($user_name, $password, FALSE);
         if ($registration_val)
         {
           $this->user->generate_userdetails($user_name);
            $data['page_title'] = 'Registration Success';
           $this->load->view('messages/registration_success', $data);
         }
         else
         {
            $data['page_title'] = 'Registration Success';
            $this->load->view('messages/registration_problem', $data);
         }
        }
    }
  }

  public function forgot_password()
  {
    $this->output->cache(3600);
    $data['page_title'] = 'Forgot Your Password';
    $this->load->view('standard/forgot_password', $data);
  }



  public function changelog()
  {
    $this->output->cache(3600);
    $data['page_title'] = 'Changelog';
    $this->load->view('standard/changelog', $data);
  }
}