<?php  
 class Crud_model extends CI_Model  
 {  
      var $table = "products";  
      var $select_column = array("id", "name", "price", "description", "image", "create_date", "update_date");  
      var $order_column = array(null, "name", "price", 'description',null,'create_date', 'update_date');  
      function make_query()  
      {  
           $this->db->select($this->select_column);  
           $this->db->from($this->table);  
           if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("name", $_POST["search"]["value"]);  
                $this->db->or_like("price", $_POST["search"]["value"]);  
                $this->db->or_like("description", $_POST["search"]["value"]);  
                $this->db->or_like("create_date", $_POST["search"]["value"]);  
                $this->db->or_like("update_date", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
           }  
           else  
           {  
                $this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables(){  
           $this->make_query();  
           if($_POST["length"] != -1)  
           {  
                $this->db->limit($_POST['length'], $_POST['start']);  
           }  
           $query = $this->db->get();  
           return $query->result();  
      }  
      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table);  
           return $this->db->count_all_results();  
      }  
      function insert_crud($data)  
      {  
           $this->db->insert('products', $data);  
      }

    function select_data($table,$collum_name, $collum_value)
     {
                    
          $this->db->select('*');
          $this->db->from($table); 
          $this->db->where($collum_name, $collum_value); 
          $query = $this -> db -> get();
        
      return $query->result();
        
     }


     function check_login($email,$password)

    {



        

        $this->db->select('*');

        $this->db->from('user');

        $this->db->where('email',$email);

        $this->db->where('password',$password);

        $query=$this->db->get();

        return $query->result();

    }


 } 