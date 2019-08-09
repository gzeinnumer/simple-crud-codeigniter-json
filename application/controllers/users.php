<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Users extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data users
    //panggil dengan cara 
    //localhost/simple-crud-codeigniter-json/index.php/users
    //localhost/simple-crud-codeigniter-json/index.php/users?id=7
    //pakai x-www-form-urlencode
    //pakai GET
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $users = $this->db->get('users')->result();
        } else {
            $this->db->where('id', $id);
            $users = $this->db->get('users')->result();
        }
        $this->response($users, 200);
    }

    //Mengirim atau menambah data users baru
    //pakai x-www-form-urlencode
    ///pakai POST
    //localhost/simple-crud-codeigniter-json/index.php/users dengan menyelipkan post di postman, maka data akan ditambah
    function index_post() {
        $data = array(
                    'id'                => $this->post('id'),
                    'username'          => $this->post('username'),
                    'name'              => $this->post('name'),
                    'pass'              => $this->post('name'),
                );
        $insert = $this->db->insert('users', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data users yang telah ada
    //panggil dengan cara 
    //localhost/simple-crud-codeigniter-json/index.php/users
    //pakai x-www-form-urlencode
    //pakai PUT
    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'username'          => $this->put('nama'),
                    'name'    => $this->put('nomor'),
                    'pass'    => $this->put('pass'),
                );
        $this->db->where('id', $id);
        $update = $this->db->update('users', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('users' => 'fail', 502));
        }
    }

    //Menghapus salah satu data users
    //panggil dengan cara 
    //localhost/simple-crud-codeigniter-json/index.php/users
    //pakai x-www-form-urlencode
    //pakai DELETE
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('users');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Masukan function selanjutnya disini
}
?>