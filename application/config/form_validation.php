<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
            'standard/login' => 
            array(
                array(
                    'field'   => 'user_name',
                    'label'   => 'Username',
                    'rules'   => 'xss_clean|required'
                  ),
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required'
                  )
            ),
            'standard/signup' => 
            array(
                array(
                    'field'   => 'user_name',
                    'label'   => 'Username',
                    'rules'   => 'xss_clean|required'
                  ),
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required|matches[passconf]|min_length[6]'
                  ),
                array(
                    'field'   => 'passconf',
                    'label'   => 'Confirm Password',
                    'rules'   => 'xss_clean|required'
                )
            ),
            'standard/forgot_password' =>
            array(
                array(
                    'field' => 'user_name',
                    'label' => 'Username',
                    'rules' => 'xss_clean|is_email|required'
                )
            ),
            'standard/change_password' =>
            array(
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required|matches[passconf]|min_length[6]'
                  ),
                array(
                    'field'   => 'passconf',
                    'label'   => 'Confirm Password',
                    'rules'   => 'xss_clean|required'
                )
            ),
            'admin/settings' =>
            array(
                array(
                    'field' => 'site_name',
                    'label' => 'Site Name',
                    'rules' => 'xss_clean|required'
                )
            ),
            'admin/populate_first_degree' =>
            array(
                array(
                    'field' => 'first_degree_number',
                    'label' => 'First Degree',
                    'rules' => 'xss_clean|required|is_number'
                )
            ),
            'admin/populate_higher_degree' =>
            array(
                array(
                    'field' => 'higher_degree_number',
                    'label' => 'Higher Degree',
                    'rules' => 'xss_clean|required|is_number'
                )
            ),
            'user/set_new_password' =>
            array(
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required|matches[passconf]|min_length[6]'
                  ),
                array(
                    'field'   => 'passconf',
                    'label'   => 'Confirm Password',
                    'rules'   => 'xss_clean|required'
                )
            ),
            'user/profile'  =>
            array(
                array(
                    'field'   => 'fullName',
                    'label'   => 'Full Name',
                    'rules'   => 'xss_clean'
                  ),
                array(
                    'field'   => 'nickName',
                    'label'   => 'Nick Name',
                    'rules'   => 'xss_clean'
                  ),
                array(
                    'field'   => 'date',
                    'label'   => 'Date',
                    'rules'   => 'xss_clean|is_natural|greater_than[0]|less_than[32]'
                  ),
                array(
                    'field'   => 'month',
                    'label'   => 'Month',
                    'rules'   => 'xss_clean'
                  ),
                array(
                    'field'   => 'year',
                    'label'   => 'Year',
                    'rules'   => 'xss_clean|is_natural|exact_length[4]'
                  ),
                array(
                    'field'   => 'hostel',
                    'label'   => 'Hostel',
                    'rules'   => 'xss_clean'
                  ),
                array(
                    'field'   => 'roomno',
                    'label'   => 'Room Number',
                    'rules'   => 'xss_clean|is_natural'
                  ),
                array(
                    'field'   => 'address',
                    'label'   => 'Address',
                    'rules'   => 'xss_clean'
                  ),
                array(
                    'field'   => 'contact',
                    'label'   => 'Contact',
                    'rules'   => 'xss_clean|is_natural'
                  ),
                array(
                    'field'   => 'email',
                    'label'   => 'Email',
                    'rules'   => 'xss_clean|valid_email'
                  )
            )
        );

/* End of file form_validation.php */
/* Location: /application/config/form_validation.php */ 