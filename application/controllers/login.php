 <?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class login extends CI_Controller {  
    
    function index()
    {

        if ($this->session->userdata('product_admin_id')!="")

        {

            redirect(base_url().'index.php/crud');

        }
      $this->load->view('login');
    }

    function login_submit()
    {
        $email=trim($this->input->post('email'));

        $password=trim($this->input->post('password'));

     

        $login_detail=$this->crud_model->check_login($email,$password);

        if(count($login_detail) > 0)

        {

            $newData=array(

                'product_admin_id'=>$login_detail[0]->id,


            );

            $this->session->set_userdata($newData);

            redirect(base_url().'index.php/crud');

        }

        else

        {

            $this->session->set_flashdata('message', 'invalid Email/password..!');

            redirect(base_url().'index.php/login','refresh');

        }
    }



       function logout()

    {

        //session_destroy();

        $this->session->unset_userdata('product_admin_id');




        $this->session->set_flashdata('message_out','Successfully Logout !');

        redirect(base_url().'index.php/login','refresh');

    }



    function registration()
    {
        $this->load->view('registration');
    }

    function registration_submit()
    {
        $nam=$this->input->post('nam');
        $email=$this->input->post('email');
        $password=$this->input->post('password');

        $data=array(
                 'name'=>$nam,
                 'email'=>$email,
                 'password'=>$password
                    );

        $this->db->insert('user',$data);
         $this->session->set_flashdata('message',' Registration Successfully done !');

        redirect(base_url().'index.php/login','refresh');

    }





     

 } 