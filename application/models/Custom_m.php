<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Custom_m
 *
 * @author windows8.1
 */
class Custom_m extends CI_Model {

    //put your code here
    function jenis($id) {
        $query = $this->db->query("Select * from jenis where id_jenis=$id")->row();
        return $query->judul;
    }

    function tutor($id) {
        $query = $this->db->query("Select * from tutor where id_tutor=$id")->row();
        if (sizeof($query)>0) {
            return $query->nama;
        } else {
            return "-";
        }
    }

}
