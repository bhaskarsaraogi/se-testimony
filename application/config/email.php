<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol'] = 'smtp';

$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_timeout'] = '30';  
$config['smtp_port'] = '465';
$config['smtp_user'] = 'melange.09.yearbook@gmail.com';
$config['smtp_pass'] = '09melange09';
               
$config['useragent'] = 'melange';
$config['charset'] = 'utf-8';  
$config['newline'] = "\r\n";  
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';

/* End of file email.php */
/* Location: /application/config/email.php */ 