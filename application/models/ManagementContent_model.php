<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ManagementContent_model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_front(){
        $result = '';
        $this->db->select('path_gambar');
        $this->db->from('content');
        $this->db->where('status', '1');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                $result = $key['path_gambar'];
            }
        }
        return $result;
    }

    function get_all(){
        $this->db->select('id,judul,path_gambar,tgl_upload,last_update,status');
        $this->db->from('content');
        $query = $this->db->get();
        return $query->result_array();
    }

    function add($gambar){
    	$judul = $this->input->post('judul');
    	$path_gambar = $gambar['file_name'];
    	$tgl_upload = date('Y-m-d H:i:s');
    	$status = $this->input->post('status');
    	$data = array(
    		'judul' => $judul,
    		'path_gambar' => $path_gambar,
    		'tgl_upload' => $tgl_upload,
    		'last_update' => $tgl_upload,
    		'status' => $status 
    	);
    	$this->db->insert('content', $data);
    }

    function update($id, $gambar){
    	$judul = $this->input->post('judul');
    	$path_gambar_lama = $this->input->post('path_gambar_lama');
    	if($path_gambar_lama!= '' || $path_gambar_lama!= NULL){
    		unlink(base_url().'content/'.$path_gambar_lama);
    	}
    	$path_gambar = $gambar['filename'];
    	$tgl_upload = date('Y-m-d H:i:s');
    	$status = $this->input->post('status');
    	$data = array(
    		'judul' => $judul,
    		'path_gambar' => $path_gambar,
    		'last_update' => $tgl_upload,
    		'status' => $status 
    	);
    	$this->db->set($data);
    	$this->db->where('id', $id);
    	$this->db->update('content');
    }
}