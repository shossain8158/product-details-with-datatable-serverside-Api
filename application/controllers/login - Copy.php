 <?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class Crud extends CI_Controller {  
      //functions  
      function index(){  
           $data["title"] = "Product Details";  
           $this->load->view('crud_view', $data);  
      }  
      function fetch_user(){  
           $this->load->model("crud_model");  
           $fetch_data = $this->crud_model->make_datatables();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = $row->name;  
                $sub_array[] = $row->price;  
                $sub_array[] = $row->description; 
                $sub_array[] = '<img src="'.base_url().'upload/'.$row->image.'" class="img-thumbnail" width="50" height="35" />'; 
                $sub_array[] = $row->create_date; 
                

                $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs" onclick="edit_data('.$row->id.')">Update</button>';  
                $sub_array[] = '<button type="button" onclick="delete_data('.$row->id.')" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs">Delete</button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"   =>  intval($_POST["draw"]),  
                "recordsTotal" => $this->crud_model->get_all_data(),  
                "recordsFiltered" => $this->crud_model->get_filtered_data(),  
                "data" =>$data  
           );  
           echo json_encode($output);  
      }  
      function user_action(){  
            
                $insert_data = array(  
                     'name'=>$this->input->post('nam'),  
                     'price'=> $this->input->post("price"),  
                     'description'=> $this->input->post("description"),  
                     'image'=>$this->upload_image(),
                     'create_date'=>date('Y-m-d'),    
                );  
                $this->load->model('crud_model');  
                $this->crud_model->insert_crud($insert_data);  
                echo 'Data Inserted';  
             
      }  
      function upload_image()  
      {  
           if(isset($_FILES["image"]))  
           {  
                $extension = explode('.', $_FILES['image']['name']);  
                $new_name = rand() . '.' . $extension[1];  
                $destination = './upload/' . $new_name;  
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);  
                return $new_name;  
           }  
      }

function edit_data()
{
  $edit_id=$this->input->post('id');

  $edit_data=$this->crud_model->select_data('products','id',$edit_id);
  // print_r($edit_data);

  ?>

                          <label>Name</label>  
                          <input type="text" value="<?php echo @$edit_data[0]->name; ?>" name="nam" id="nam" class="form-control" />  
                          <br /> 
                          <input type="hidden" name="edit_id" id="edit_id" value="<?php echo @$edit_data[0]->id; ?>"> 
                          <label>Price</label>  
                          <input type="text" value="<?php echo @$edit_data[0]->price; ?>" name="price" id="price" class="form-control" />  
                          <br />  
                          <label>Description</label>  
                          
                          <textarea class="form-control" name="description" id="description"><?php echo @$edit_data[0]->description; ?></textarea>
                          <br />  
                          <label>Select User Image</label>  
                          <input type="file" name="image_edit" id="image" />  
                          <input type="hidden" value="<?php echo @$edit_data[0]->image; ?>" name="old_image" id="old_image" class="form-control" />  
                          <img src="<?php echo base_url().'upload/'.@$edit_data[0]->image; ?>" class="img-thumbnail" width="50" height="35" />



  <?php


}

  function user_action_update(){ 

  $edit_id=$this->input->post('edit_id'); 
            
                $insert_data = array(  
                   
                     'name'=>$this->input->post('nam'),  
                     'price'=> $this->input->post("price"),  
                     'description'=> $this->input->post("description"),  
                     'image'=>$this->upload_image_edit(),
                     'update_date'=>date('Y-m-d'),    
                );  
                $this->load->model('crud_model');  
                // $this->crud_model->update_crud($insert_data);  
                $this->db->where('id',$edit_id);
                $this->db->update('products',$insert_data);
                echo 'Data Updated';  
             
      }  
      function upload_image_edit()  
      {  
       
       
           if($_FILES["image_edit"]["name"]!="")  
           {  

                $extension = explode('.', $_FILES['image_edit']['name']);  
                $new_name = rand() . '.' . $extension[1];  
                $destination = './upload/' . $new_name;  
                move_uploaded_file($_FILES['image_edit']['tmp_name'], $destination);  
                @unlink('./upload/'.$this->input->post('old_image'));
                return $new_name;  
           }
           else
           {
            $new_name=$this->input->post('old_image');
            return $new_name;
           }  
      }  


function delete_data()
{
  $delete_id=$this->input->post('id');
  $delete_data=$this->crud_model->select_data('products','id',$delete_id);

  $image=@$delete_data[0]->image;

  @unlink('./upload/'.$image);

  $this->db->where('id',$delete_id);
  $this->db->delete('products');
  $result=1;
  echo json_encode($result);

}

 } 