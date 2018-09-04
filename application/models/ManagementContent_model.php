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
    	if($status == 1){
            $this->db->set('status', '0');
            $this->db->where('status', '1');
            $this->db->update('content');
        }
        $data = array(
    		'judul' => $judul,
    		'path_gambar' => $path_gambar,
    		'tgl_upload' => $tgl_upload,
    		'last_update' => $tgl_upload,
    		'status' => $status 
    	);
    	$this->db->insert('content', $data);

    }

    function change($id,$gambar){
        $path_gambar = $gambar['file_name'];
        $last_update = date('Y-m-d H:i:s');
        $data = array(
            'path_gambar' => $path_gambar,
            'last_update' => $tgl_upload
        );
        $this->db->where('id', $id);
        $this->db->update('content', $data);
    }

    function update($id){
    	$judul = $this->input->post('judul');
    	$last_update = date('Y-m-d H:i:s');
    	$status = $this->input->post('status');
    	if($status == 1){
            $this->db->set('status', '0');
            $this->db->where('status', '1');
            $this->db->update('content');
        }
        $data = array(
    		'judul' => $judul,
    		'last_update' => $tgl_upload,
    		'status' => $status 
    	);
    	$this->db->set($data);
    	$this->db->where('id', $id);
    	$this->db->update('content');
    }

    function delete($id){
        $gambar = $this->get_path_gambar($id);
        if($gambar!='' || $gambar!= NULL){
            $pecah_gambar = explode('.', $gambar);
            $eliminasi = $pecah_gambar[0];
            $u_tahun = substr($eliminasi,0,4);
            $u_bulan = substr($eliminasi,5,2);
            unlink('./content/'.$u_tahun.'/'.$u_bulan.'/'.$gambar);
        }
        $this->db->where('id', $id);
        $this->db->delete('content');
    }

    function get_path_gambar($id){
     $result = '';
        $this->db->select('path_gambar');
        $this->db->from('content');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $key) {
                $result = $key['path_gambar'];
            }
        }
        return $result;   
    }
}