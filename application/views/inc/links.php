<?php
if ($this->session->userdata('admin_controls'))
{
  if ($this->session->userdata('logged_in'))
  {
    $links = array(
      0 => site_url().'/admin/dashboard',
      1 => site_url().'/admin/settings',
      2 => site_url().'/admin/logout',
      3 => site_url().'/main/bitsmelange'
      );
    $links_text = array(
      0 => 'Dashboard',
      1 => 'Settings',
      2 => 'Logout',
      3 => '#bitsmelange'

      );
  }
  else
  {
    $links = array(
      0 => site_url().'/admin',
      1 => site_url().'/admin/login',
      2 => site_url().'/main/bitsmelange'
      );
    $links_text = array(
      0 => 'Home',
      1 => 'Login',
      2 => '#bitsmelange'
      );
  }
}
else
{
  if ($this->session->userdata('login_flag') == 1)
  {
    $links = array(
      0 => site_url().'/user/dashboard',
      1 => site_url().'/user/edit_profile',
      2 => site_url().'/user/profile/me',
      3 => site_url().'/user/your_testimonials',
      4 => site_url().'/user/logout',
      5 => site_url().'/main/bitsmelange'
      );
    $links_text = array(
      0 => 'Dashboard',
      1 => 'Settings',
      2 => 'Profile',
      3 => 'Testimonials',
      4 => 'Logout',
      5 => '#bitsmelange'
      );
  }
  else if ($this->session->userdata('login_flag') == 2)
  {
    $links = array(
      0 => site_url().'/user/dashboard',
      1 => site_url().'/user/logout',
      2 => site_url().'/main/bitsmelange'
      );
    $links_text = array(
      0 => 'Dashboard',
      1 => 'Logout',
      2 => '#bitsmelange'
      );
  }
  else
  {
    $links = array(
      0 => site_url().'/main',
      1 => site_url().'/main/register',
      2 => site_url().'/main/login',
      3 => site_url().'/main/bitsmelange'
      );

    $links_text = array(
      0 => 'Home',
      1 => 'Register',
      2 => 'Login',
      3 => '#bitsmelange'
      );
  }
}
?>