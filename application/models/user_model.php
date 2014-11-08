<?php

class User_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }

  function get_user_id($user_name)
  {
    $result = $this->db->get_where('user_master', array('user_name' => $user_name));
    $id = $result->first_row()->iduser_master;
    return $id;
  }

  function check_user_name_exists($user_name)
  {
    $result = $this->db->get_where('user_master', array('user_name' => $user_name));
    return ($result->num_rows())?TRUE:FALSE;
  }

  function get_user_role($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_roles', array('user_master_iduser_roles' => $id));
    return $result->num_rows()?$result->first_row()->user_role:1;
  }

  function generate_userdetails($user_name, $data = array())
  {
    $id = $this->get_user_id($user_name);
    $data['user_master_iduser_details'] = $id;
    $this->db->insert('user_details', $data);
  }

  function get_userdetails($query, $via='name')
  {
    if ($via == 'name')
    {
      $id = $this->get_user_id($query);
      $result = $this->db->get_where('user_details', array('user_master_iduser_details' => $id));
    }
    else
    {
      $result = $this->db->get_where('user_details', array('iduser_details' => $query));
    }
    return $result->first_row();
  }

  function get_userdetails_id($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_details', array('user_master_iduser_details' => $id));
    return $result->first_row()->iduser_details;
  }

  function update_userdetails($user_name, $data)
  {
    $id = $this->get_user_id($user_name);
    $this->db->where('user_master_iduser_details', $id);
    $this->db->update('user_details', $data);
  }

  function search_users($query)
  {
    $this->db->like('id_number', $query);
    $this->db->or_like('name', $query);
    $this->db->or_like('nick', $query);
    $result = $this->db->get('user_details');
    return $result->result();
  }

  function check_account_verified($id)
  {
    $result = $this->db->get_where('user_verify', array('user_master_iduser_master' => $id));
    if ($result->num_rows())
    {
      $account_verified = $result->first_row()->account_verified;
      if ($account_verified == 0)
      {
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }
    else
    {
      return FALSE;
    }
  }

  function verify_account($verification_key)
  {
    $data = array(
      'account_verified'  => 1
    );
    $this->db->where('verification_key', $verification_key);
    $result = $this->db->update('user_verify', $data);
    return $result;
  }

  function generate_verification_key($user_name)
  {
    $result = $this->db->get_where('user_master', array('user_name' => $user_name));
    $verification_key = md5($user_name);
    $id = $result->first_row()->iduser_master;
    $data = array(
      'verification_key'          => $verification_key,
      'account_verified'          => 0,
      'user_master_iduser_master' => $id
    );
    $this->db->insert('user_verify', $data);
    return $verification_key;
  }

  function get_verification_key($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_verify', array('user_master_iduser_master' => $id));
    return $result->first_row()->verification_key;
  }

  function send_verification_mail($user_name)
  {
    $verification_key = $this->get_verification_key($user_name);

    /*
     * Configure this part
     */
    $toemail = $user_name.'@bits-goa.ac.in';

    $this->load->library('email');

    $this->email->from('melange.09.yearbook@gmail.com', 'Melange 2009');
    $this->email->to($toemail);
    $this->email->reply_to('melange.09.yearbook@gmail.com', 'Melange 2009');

    $message = 'Click the following link to confirm your registration.<br/><a href="'.site_url().'user/verify/'.$verification_key.'">'.site_url().'user/verify/'.$verification_key.'</a>';

    $this->email->subject('Melange - Account Verification');
    $this->email->message($message);

    $this->email->send();
  }

  function send_new_password($user_name, $password)
  {
    /*
     * Configure this part
     */
    $toemail = $user_name.'@goa.bits-pilani.ac.in';

    $this->load->library('email');

    $this->email->from('melange.10.yearbook@gmail.com', 'Melange 2009');
    $this->email->to($toemail);
    $this->email->reply_to('melange.10.yearbook@gmail.com', 'Melange 2009');

    $message = 'You had requested for a new password.<br/>Your new password is '.$password;

    $this->email->subject('Melange - Forgot Password');
    $this->email->message($message);

    $this->email->send();
  }

  function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=true, $include_numbers=true, $include_special_chars=true)
  {
    $length = rand($chars_min, $chars_max);
    $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
    if ($include_numbers)
    {
      $selection .= "1234567890";
    }
    if ($include_special_chars)
    {
      $selection .= "!@\"#$%&[]{}?|";
    }

    $password = "";
    for($i=0; $i<$length; $i++)
    {
      $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
      $password .=  $current_letter;
    }

    return $password;
  }

  function export_user_data($user_id)
  {
    $this->load->helper('csv');

    $result = $this->db->query('SELECT content, um2.user_name AS testimonial_by FROM user_master AS um1, user_master AS um2, testimonials, user_details AS ud1, user_details AS ud2 WHERE testimonial_for = ud1.iduser_details AND testimonial_by = ud2.iduser_details AND um1.iduser_master = ud1.user_master_iduser_details AND um2.iduser_master = ud2.user_master_iduser_details AND testimonial_for = '.$user_id);
    echo query_to_csv($result, TRUE, 'melange_testimonials_'.date('d_m_Y').'.csv');
  }

  function count_users()
  {
    $result = $this->db->count_all('user_master');
    return $result;
  }

}