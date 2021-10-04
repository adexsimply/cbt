
<?php
$role_id = $active_user->role_id;
// if ($role_id =='1') {
// 	$this->load->view('dashboard/admin');
// }
// elseif ($role_id =='2') {
// 	$this->load->view('dashboard/teacher');
// }
if ($role_id =='3') {
	$this->load->view('dashboard/student');
}
else {
	$this->load->view('admin/dashboard');
}
// else {
// 	exit();
// }

?>

