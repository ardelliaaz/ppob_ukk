<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class level_model extends CI_Model {

public function get_level()
{
    return $this->db->get('level')
                    ->result();
}

// public function get_kategori()
// {
//     return $this->db->get('kategori')
//                     ->result();
// }

public function get_data_level_by_id($id)
{
    return $this->db->where('id_level', $id)
                    ->get('level')
                    ->row();
}
