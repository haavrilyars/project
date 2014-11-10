<?php
/**
 * Created by PhpStorm.
 * User: haho
 * Date: 10/15/2014
 * Time: 2:06 PM
 */
class MProducts extends CI_Model{
    function __construct(){
        parent::__construct();

    }
    function getProduct($id){
        $data = array();
        //$option = array('id'=>$id);
        $this->db->where('id',$id);
        $Q = $this->db->get('products');
        if($Q->num_rows()>0){
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }
    function getAllProducts(){
        $data = array();
        $this->db->where('status','active');
        $Q = $this->db->get('products');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function getMainFeature(){
        $data = array();
        $this->db->select("id,name,shortdesc,image");
        $this->db->where('featured','true');
        $this->db->where('status', 'active');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(1);
        $Q = $this->db->get('products');
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "shortdesc" => $row['shortdesc'],
                    "image" => $row['image']
                );
            }
        }
        $Q->free_result();
        return $data;

    }
    function getRandomProducts($limit,$skip){
        $data = array();
        $temp = array();
        if ($limit == 0){
            $limit=3;
        }
        $this->db->select("id,name,thumbnail,category_id");
        $this->db->where('id !=', $skip);
        $this->db->order_by("category_id","asc");
        $this->db->limit(100);
        $Q = $this->db->get('products');
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $temp[$row['category_id']] = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "thumbnail" => $row['thumbnail']
                );
            }
        }

        shuffle($temp);
        while(count($temp)>3){
            array_shift($temp);
        }
        //array_shift($temp);

        $Q->free_result();
        return $temp;
    }
    function getProductsByCateogry($catid){
        $data = array();
        $this->db->where('category_id',$catid);
        $Q=$this->db->get('products');
        if($Q->num_rows()>0){
            foreach($Q ->result_array() as $row){
                $data[] = $row
                ;
            }
        }
        $Q->free_result();
        return $data;
    }
    function getProductsByGroup($skip,$grouping){
        $data = array();
        $this->db->where('id != ',$skip);
        $this->db->where('grouping' , $grouping);
        $this->db->order_by('id','RANDOM');
        $this->db->limit(3);
        $Q=$this->db->get('products');
        if($Q->num_rows()>0){
            foreach($Q ->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function search($term){
        $data= array();
        $this->db->like('name',$term);
        $this->db->or_like('shortdesc',$term);
        $this->db->or_like('longdesc',$term);
        $this->db->order_by('name','asc');
        $this->db->limit(50);
        $Q=$this->db->get("products");
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    function addProduct(){
        $data = array(
            'name'=> $_POST['name'],
            'shortdesc' =>$_POST['shortdesc'],
            'longdesc' =>$_POST['longdesc'],
            'status' =>$_POST['status'],
            'grouping' =>$_POST['grouping'],
            'category_id' =>$_POST['category_id'],
            'featured' => $_POST['featured'],
            'price' =>$_POST['price']
        );
        if(isset($_FILES['image'])&&!empty($_FILES['image']['name'])){


            $config['upload_path'] = './images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '200';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width']  = '0';
            $config['max_height']  = '0';
            $this->load->library('upload', $config);


            if(!$this->upload->do_upload('image')){
                $this->upload->display_errors();
                exit();
            }
            $image = $this->upload->data();

            if ($image['file_name']){
                $data['image'] = "/images/".$image['file_name'];

            }

            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] ='.'.$data['image'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 215;
            $config['height'] = 300;
            //$this->load->library('image_lib',$config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $img_source = $data['image'];

            $thumb_full =  substr($img_source,8);
            $thumb_duoi = strstr($thumb_full,'.');
            $thumb_main = substr($thumb_full,0,strpos($thumb_full,'.'));

            $thum_final = '/images/'.$thumb_main.'_thumb'.$thumb_duoi;
            $data['thumbnail'] = $thum_final;
        }
        //var_dump($_FILES);
        $this->db->insert('products',$data);
        $new_product_id = $this->db->insert_id();
        if($_POST['colors']){
            foreach($_POST['colors'] as $value){
                $data = array(
                    'product_id' =>$new_product_id,
                    'color_id' =>$value
                );
            }
            $this->db->insert('products_colors',$data);
        }
        if($_POST['sizes']){
            foreach($_POST['sizes'] as $value){
                $data = array(
                    'product_id' =>$new_product_id,
                    'size_id' =>$value
                );
            }
            $this->db->insert('products_sizes',$data);
        }

    }

    function updateProduct($id){
        $data = array(
            'name'=> $_POST['name'],
            'shortdesc' =>$_POST['shortdesc'],
            'longdesc' =>$_POST['longdesc'],
            'status' =>$_POST['status'],
            'grouping' =>$_POST['grouping'],
            'category_id' =>$_POST['category_id'],
            'featured' => $_POST['featured'],
            'price' =>$_POST['price']
        );
        //var_dump($data);
        //var_dump($_FILES);
        //var_dump(isset($_FILES['image']));
        //var_dump(!empty($_FILES['image']));
        if(isset($_FILES['image'])&&!empty($_FILES['image']['name'])){


            $config['upload_path'] = './images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '200';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width']  = '0';
            $config['max_height']  = '0';
            $this->load->library('upload', $config);


            if(!$this->upload->do_upload('image')){
                $this->upload->display_errors();
                exit();
            }
            $image = $this->upload->data();

            if ($image['file_name']){
                $data['image'] = "/images/".$image['file_name'];

            }

            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] ='.'.$data['image'];
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 215;
            $config['height'] = 300;
            //$this->load->library('image_lib',$config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $img_source = $data['image'];

            $thumb_full =  substr($img_source,8);
            $thumb_duoi = strstr($thumb_full,'.');
            $thumb_main = substr($thumb_full,0,strpos($thumb_full,'.'));

            $thum_final = '/images/'.$thumb_main.'_thumb'.$thumb_duoi;
            $data['thumbnail'] = $thum_final;
        }
        $this->db->where('id',$id);
        $this->db->update('products',$data);

        $this->db->where('product_id',$id);
        $this->db->delete('products_colors');
        $this->db->where('product_id',$id);
        $this->db->delete('products_sizes');

        if($_POST['colors']){
            foreach($_POST['colors'] as $value){
                $data = array(
                    'product_id' =>$id,
                    'color_id' =>$value
                );
            }
            $this->db->insert('products_colors',$data);
        }
        if($_POST['sizes']){
            foreach($_POST['sizes'] as $value){
                $data = array(
                    'product_id' =>$id,
                    'size_id' =>$value
                );
            }
            $this->db->insert('products_sizes',$data);
        }
    }

    function deleteProduct($id){
        $data = array(
            'status' => 'inactive'
        );
        $this->db->where('id',$id);
        $this->db->update('products',$data);
    }
    function batchmode(){
        if(count($this->input->post('p_id'))){
            $data = array(
                "category_id" => $this->input->post('category_id'),
                "grouping" => $this->input->post('grouping')
            );
            $idlist = implode(',',array_values($this->input->post('p_id')));
            //var_dump(array_values($this->input->post('p_id')));
            $where = "id in ($idlist)";
            $this->db->where($where);
            $this->db->update('products',$data);
            $this->session->set_flashdata('message','Products have been updated');
        }
        else{
            $this->session->set_flashdata('message','Nothing to update');
        }
    }
    function exportCSV(){
        $this->load->dbutil();
        $Q = $this->db->query('select * from products');
        return $this->dbutil->csv_from_result($Q,",","\n");
    }
    function reassignProducts(){
        $orphans = $this->session->userdata('orphans');
        $category_id = $this->input->post('category_id');
        $data = array(
            "category_id" =>$category_id
        );
        $idlist = implode(',',array_keys($orphans));

        $where = "id in($idlist)";
        $this->db->where($where);
        $this->db->update('products',$data);
    }
    function getAssignedColors($id){
        $data = array();
        $this->db->select('color_id');
        $this->db->where('product_id',$id);
        $Q = $this->db->get('products_colors');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[] = $row['color_id'];
            }
        }
        $Q->free_result();
        return $data;
    }
    function getAssignedSizes($id){
        $data = array();
        $this->db->select('size_id');
        $this->db->where('product_id',$id);
        $Q = $this->db->get('products_sizes');
        if($Q->num_rows()>0){
            foreach($Q->result_array() as $row){
                $data[] = $row['size_id'];
            }
        }
        $Q->free_result();
        return $data;
    }
}