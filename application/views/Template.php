<?php
//build template
$this->load->view('part/header');
$this->load->view('part/sidebar');
$this->load->view($content);
$this->load->view('part/footer');
?>