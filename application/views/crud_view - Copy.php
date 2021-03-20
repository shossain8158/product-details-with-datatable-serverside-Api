<html>  
 <head>  
   <title><?php echo $title; ?></title>  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <style>  
           body  
           {  
                margin:0;  
                padding:0;  
                background-color:#f1f1f1;  
           }  
           .box  
           {  
                width:900px;  
                padding:20px;  
                background-color:#fff;  
                border:1px solid #ccc;  
                border-radius:5px;  
                margin-top:10px;  
           }  
      </style>  
 </head>  
 <body>  
      <div class="container box">  
           <h3 align="center"><?php echo $title; ?></h3><br />  
           <div class="table-responsive">  
                <br />  
                <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>  
                <br /><br />  
                <table id="user_data" class="table table-bordered table-striped">  
                     <thead>  
                          <tr>  
                               <th width="35%">Name</th>  
                               <th width="35%">Price</th>  
                               <th width="10%">Description</th> 
                               <th width="10%">Image</th>   
                               <th width="10%">Created date</th>  
                              
                               <th width="10%">Edit</th>  
                               <th width="10%">Delete</th>  
                          </tr>  
                     </thead>  
                </table>  
           </div>  
      </div>  
 </body>  
 </html>  
 <div id="userModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="user_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add Product</h4>  
                     </div>  
                     <div class="modal-body">  
                          <label>Name</label>  
                          <input type="text" name="nam" id="nam" class="form-control" />  
                          <br />  
                          <label>Price</label>  
                          <input type="text" name="price" id="price" class="form-control" />  
                          <br />  
                          <label>Description</label>  
                          <!-- <input type="text" name="last_name" id="last_name" class="form-control" />   -->
                          <textarea class="form-control" name="description" id="description"></textarea>
                          <br />  
                          <label>Select User Image</label>  
                          <input type="file" name="image" id="image" />  
                     </div>  
                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success" value="Add" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div> 

 <div id="userModal_for_edit" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="user_form_edit">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Edit Product</h4>  
                     </div>  
                     <div class="modal-body" id="edit_div">  
                        <!--   <label>Name</label>  
                          <input type="text" name="nam" id="nam" class="form-control" />  
                          <br /> 
                          <input type="hidden" name="edit_id" id="edit_id"> 
                          <label>Price</label>  
                          <input type="text" name="price" id="price" class="form-control" />  
                          <br />  
                          <label>Description</label>  
                          
                          <textarea class="form-control" name="description" id="description"></textarea>
                          <br />  
                          <label>Select User Image</label>  
                          <input type="file" name="image" id="image" />   -->
                     </div>  
                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success" value="Update" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div> 

 <script type="text/javascript" language="javascript" >  
 $(document).ready(function(){  
  // alert('<?php echo base_url(); ?>');
      var dataTable = $('#user_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo base_url() . 'index.php/crud/fetch_user'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 3, 4],  
                     "orderable":false,  
                },  
           ],  
      });  
      $(document).on('submit', '#user_form', function(event){  
           event.preventDefault();  
           var nam = $('#nam').val();  
           var price = $('#price').val();  
           var description = $('#description').val();  
           var extension = $('#image').val().split('.').pop().toLowerCase();  
           if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
           {  
                alert("Invalid Image File");  
                $('#image').val('');  
                return false;  
           }  
           if(nam != '' && price != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url() . 'index.php/crud/user_action'?>",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {  
                          // alert(data);  
                          $('#user_form')[0].reset();  
                          $('#userModal').modal('hide');  
                          dataTable.ajax.reload();  
                     }  
                });  
           }  
           else  
           {  
                alert("Bother Fields are Required");  
           }  
      }); 

  $(document).on('submit', '#user_form_edit', function(event){  
           event.preventDefault();  
             
            
          
            
        
           
            
                $.ajax({  
                     url:"<?php echo base_url() . 'index.php/crud/user_action_update'?>",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     success:function(data)  
                     {  
                          // alert(data);  
                          $('#user_form_edit')[0].reset();  
                          $('#userModal_for_edit').modal('hide');  
                          dataTable.ajax.reload();  
                     }  
                });  
             
             
      }); 
 });  
 </script>  

 <script>
   function edit_data(id)
   {
    // alert(id);
    // $("#edit_id").val(id);
   $('#userModal_for_edit').modal({show:true});

   $.ajax({   
        type: "POST",
        dataType:'html',  
        url:"<?php echo base_url();?>index.php/crud/edit_data",  
        data: {id:id},
        //async: false,
        success: function(data)
        {     

         // alert(data);
         // console.log(data);
         // $('#name').val(data.category_name);
         // $('#dis_name_edit').val(data.display_name);
         // $('#category_id').val(data.cat_id);

         $('#edit_div').html(data)
     

      }
  });

   }
 </script>


 <script>
   function delete_data(id)
   {
         $.ajax({   
        type: "POST",
        dataType:'json',  
        url:"<?php echo base_url();?>index.php/crud/delete_data",  
        data: {id:id},
        //async: false,
        success: function(data)
        {     

         alert('Delete successfully done');
         location.reload();
         // console.log(data);
         // $('#name').val(data.category_name);
         // $('#dis_name_edit').val(data.display_name);
         // $('#category_id').val(data.cat_id);

         // $('#edit_div').html(data)
     

      }
  });
   }
 </script>