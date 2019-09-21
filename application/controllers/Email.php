<?php


class Email extends CI_Controller{
    function do_send_mail($username, $nomorPendaftaran, $subject = "Payment Invoice")
	{
		// $from_email = "sigitsuryono0225@gmail.com";
		$config = Array(
			'protocol' => 'mail',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => '587',
			'smtp_user' => 'payment.lauwba@gmail.com',
			'smtp_pass' => 'admin>_<',
			'mailtype' => 'html',
			'wordwrap' => TRUE,
			'charset' => 'utf-8'
		);
		//get userdetail
		$data['detail'] = $this->db->query("SELECT * FROM pendaftar INNER JOIN`jenis`ON pendaftar.training = jenis.id_jenis INNER JOIN kelas ON jenis.id_jenis=kelas.id_jenis WHERE pendaftar.id='$nomorPendaftaran'")->row();
        $msg = $this->load->view("invoices-mail", $data, TRUE);

		$this->load->library('email', $config);
// 		$this->email->set_header('Content-Type', 'text/html');
		$this->email->set_newline("\r\n");

		$this->email->from("payment.lauwba@gmail.com");
		$this->email->to($username);
		$this->email->subject($subject);
		$this->email->message($msg);

		//Send mail
		if ($this->email->send()) {
			print("Email berhasil terkirim.");
		} else {
			echo $this->email->print_debugger();
			// print("Email gagal terkirim.");
		}
	}
	
}