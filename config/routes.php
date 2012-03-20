<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['assets/([0-9a-zA-Z]+/)?(css|js|img)/([a-zA-Z0-9\-_\/]+)([a-zA-Z\.]{2,4})'] = "assets/index/index/$2/$4/$3";
$route['404_override'] = '';
$route['pregnancy/(:any)'] = 'pregnancy/read/$1';
$route['pregnancy/all'] = 'pregnancy/all';
$route['baby/(:any)'] = 'baby/read/$1';
$route['baby/all'] = 'baby/all';
$route['toddler/(:any)'] = 'toddler/read/$1';
$route['toddler/all'] = 'toddler/all';
$route['preschooler/(:any)'] = 'preschooler/read/$1';
$route['preschooler/all'] = 'preschooler/all';
$route['parents/(:any)'] = 'parents/read/$1';
$route['parents/all'] = 'parents/all';
$route['events/(:any)'] = 'events/read/$1';
$route['events/all_events_list'] = 'events/all_events_list';
$route['programs/(:any)'] = 'programs/read/$1';
$route['programs/all_programs_list'] = 'programs/all_programs_list';
$route['reviews/(:any)'] = 'reviews/read/$1';
$route['reviews/all_reviews_list'] = 'reviews/all_reviews_list';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
