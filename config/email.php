<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['protocol'] = 'smtp';
//$config['smtp_port'] = '3535';
$config['smtp_port'] = '587';
//$config['smtp_host'] = 'smtpout.asia.secureserver.net';
//$config['smtp_user'] = 'noreply@xhiber-dynamic.com';
//$config['smtp_pass'] = 'bionima714';
//$config['smtp_host'] = 'smtpout.asia.secureserver.net';
//$config['smtp_user'] = 'support@bdmg.com';
//$config['smtp_pass'] = 'bdmg2011';
$config['smtp_host'] = 'smtp.mailgun.org';
$config['smtp_user'] = 'postmaster@atraxia.mailgun.org';
$config['smtp_pass'] = '5nz2d4hka1n3';
$config['email_from_address'] = 'noreply@mumcentre.com';
$config['email_from_name'] = 'Mumcentre™ Administrator';

$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;


/* End of file config.php */
/* Location: ./system/application/config/email.php */
