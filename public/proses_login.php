<?php 
$host_db="localhost";
$user_db="root";
$pass_db="";
$nama_db="belajar";

$mysqli = new mysqli($host_db,$user_db,$pass_db,$nama_db);

if(isset($_POST['login'])){
	$email = $mysqli->real_escape_string($_POST['email']);
	$password = $mysqli->real_escape_string($_POST['password']);

	//cek user login 
	$cek_login = $mysqli->query("select *from member where email='$email'");
	$ktm_login = $cek_login->num_rows;
	$data_login = $cek_login->fetch_assoc();

	if($ktm_login>=1){
		//login email tersedia
		//verify password 
		if(password_verify($password,$data_login['passwd'])){
			echo "Berhasil";
			//silakan buat session dan redirect disini
			session_start();
			$_SESSION['id_member']=$data_login['id'];

		}else{
			echo "Login gagal, Silakan coba lagi!";
		}
	}else{
		//login gagal, email tidak tersedia
		echo "Login gagal, Email tidak tersedia!";
	}

	$mysqli->close();
}
?>