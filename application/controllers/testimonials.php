<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class testimonials extends CI_Controller {
 
  function __construct() {
    parent::__construct();
    if ($this->session->userdata('logged_in') == TRUE)
    {
      $this->session->set_userdata(array('login_flag' => 1));
    }
    else
    {
      $this->session->set_userdata(array('login_flag' => 0));
    }
    $this->load->model('settings_model', 'settings');
    $this->session->set_userdata(array('admin_controls' => FALSE, 'site_name' => $this->settings->get_site_name()));
  }
  
  public function add_testimonial($to_id)
  {    
    if ($this->session->userdata('login_flag') == 1)
    {
      $this->load->model('testimonial_model', 'testimonial');
      $this->load->model('user_model', 'user');
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $testimonial_content = $this->input->post('testimonial_content');
      $data = array(
        'content'           => $testimonial_content,
        'testimonial_for'   => $to_id,
        'testimonial_by'    => $user_id
        );
      $this->testimonial->add_testimonial($data);
      redirect('user/profile/'.$to_id, 'location');
    }
    else
    {
      redirect('main/login', 'location');
    }       
  }
  
  public function make_public($testimonial_id)
  { 
    if ($this->session->userdata('login_flag') == 1)
    {
      $this->load->model('testimonial_model', 'testimonial');
      $this->load->model('user_model', 'user');
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $this->testimonial->change_visibility($testimonial_id, $user_id, 1);
      redirect('user/dashboard', 'location');
    }
    else
    {
      redirect('main/login', 'location');
    }     
  }
  
  public function make_private($testimonial_id)
  { 
    if ($this->session->userdata('login_flag') == 1)
    {
      $this->load->model('testimonial_model', 'testimonial');
      $this->load->model('user_model', 'user');
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $this->testimonial->change_visibility($testimonial_id, $user_id, 0);
      redirect('user/dashboard', 'location');
    }
    else
    {
      redirect('main/login', 'location');
    }
  }
  
  public function delete_testimonial($testimonial_id) 
  {
    if ($this->session->userdata('login_flag') == 1)
    {
      $this->load->model('testimonial_model', 'testimonial');
      $this->load->model('user_model', 'user');
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $this->testimonial->delete_testimonial($testimonial_id, $user_id);
      redirect('user/dashboard', 'location');
    }
    else
    {
      redirect('main/login', 'location');
    }     
  }
  
}