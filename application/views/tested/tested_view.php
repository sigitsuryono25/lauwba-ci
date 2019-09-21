<?php  $silabus = $this->db->query("SELECT silabus FROM jenis WHERE id_jenis IN ('".$detail->id_jenis."')")->row()->silabus;
print_r($silabus);


?>