<?php
/**
 * Created by IntelliJ IDEA.
 * User: OpenSkyMedia
 * Date: 2/1/12
 * Time: 5:41 PM
 */

class Gallery_model extends CI_Model {

    var $gallery_path;
    var $gallery_path_url;

    function __construct()
    {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->model('Client_model');
        $this->load->model('Projects_model');
        if (!$this->ion_auth->logged_in()) {
            $this->login      = 'false';
            $this->user_id      = '';
            $this->user_name    = '';
        } else {
            $user               = $this->ion_auth->user()->row();
            $this->user_id      = $user->id;
            $this->user_name    = $user->username;
            $this->login      = 'true';
            $this->thumb_size_width = '500';
            $this->thumb_size_height = '300';
            $this->max_image_size = '1000';

            $this->gallery_path = realpath(APPPATH . '../assets/images/gallery');
            $this->gallery_path_url = base_url().'assets/images/gallery/';
        }
    }

    /* Uploads images to the site and adds to the database. */
    function do_upload($data) {



        // CHECK THE DATA CREATED FOR INSERT

        $this->db->insert('photos', $data);
    }

    function deleteImage($id, $redirect) {

        $query = $this->db->get_where('photos',array('photo_id' => $id));
        $row = $query->row();

        $filename = $row->photoname;

        $file = $this->gallery_path .'/' . $filename;
        $file2 = $this->gallery_path .'/thumbs/' . $filename;
        unlink($file);
        unlink($file2);


        $this->db->where(array('photo_id'=>$id));
        $this->db->delete('photos');
        redirect($redirect);
    }

    /* Displays Images on a page */

    function get_images() {

        $files = scandir($this->gallery_path);
        $files = array_diff($files, array('.', '..', 'thumbs'));

        $images = array();

        foreach ($files as $file) {
            $images []= array (
                'url' => $this->gallery_path_url . $file,
                'thumb_url' => $this->gallery_path_url . 'thumbs/' . $file
            );
        }

        return $images;
    }

    function get_images_from_db($id) {
        $user = $this->user_id;
        $this->db->select('p.fullsize, p.thumb, p.userid, p.projectid');
        $this->db->from('photos as p');
        $this->db->where('p.busid', $id);
        return $this->db->get();
    }

    function profile_get_images_from_db($id) {
        $user = $this->user_id;
        $this->db->select('p.photo_id, p.fullsize, p.thumb, p.userid');
        $this->db->from('photos as p');
        $this->db->where('p.userid', $user);
        return $this->db->get();

    }

    function get_video_from_db($id) {
        $user = $this->user_id;
        $this->db->select('v.id, v.title, v.link, v.busid');
        $this->db->from('video as v');
        $this->db->where('v.busid', $id);
        $this->db->limit(1);
        // get the results.. cha-ching
        return $this->db->get();

        // any results?
        if($q->num_rows() !== 1)
        {
            return FALSE;
        }

        return $this->db->get();

    }

    function profile_get_video_from_db($id) {
        $user = $this->user_id;
        $this->db->select('v.id, v.title, v.link, v.busid');
        $this->db->from('video as v');
        $this->db->where('v.userid', $user);

        $query = $this->db->get();
        $row = $query->row_array();

        $num = $query->num_rows();
        if ($num < 1)
        {
            $row['link'] = 'No Link';
            return $row;
        } else {
            return $row;
        }



    }

    function get_project_id() {
        $this->db->select('b.idprojects_table');
        $this->db->from ('projects_table AS b');
        $this->db->where ('b.user_id', $this->user_id);
        $query = $this->db->get();

        $row = $query->row();

        if ($query->num_rows() > 0) {

            $content = $row->idprojects_table;

            return $content;
        }
    }

    function updateVideo($videoid, $redirect, $userid, $busid) {

        $user = $this->user_id;

        $this->db->select('v.id');
        $this->db->from ('video AS v');
        $this->db->where ('v.busid', $busid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = array(
                'link' => $videoid,
                'busid' => $busid,
                'userid' => $user,
            );
            $this->db->select('v.id');
            $this->db->from ('video AS v');
            $this->db->where ('busid', $busid);
            $this->db->update('video', $data);
        }

        else {
            $data = array(
                'link' => $videoid,
                'busid' => $busid,
                'userid' => $user,
            );
            $this->db->insert('video', $data);

        }

        $goback = $redirect . '/' . $busid;

        redirect($goback);
    }



}



