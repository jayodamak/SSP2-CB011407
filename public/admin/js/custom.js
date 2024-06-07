$(document).ready(function(){
    

    //Update CMS Page Status
    $(document).on("click",".updateCmsPageStatus", function(){
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("page_id")//.substring(5); //page-1
        // alert(page_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-cms-page-status',
            data: {status:status, page_id:page_id}, 
            success: function(resp){
                if(resp['status']==0){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-on'style='color:blue' status='Active'></i>");
                }
            
            }, error: function(){
                alert("Error");
            }
        });
    });


     //Update Category Status
     $(document).on("click",".updateCategoryStatus", function(){
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id")//.substring(5); //category-1
        // alert(category_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: {status:status, category_id:category_id}, 
            success: function(resp){
                if(resp['status']==0){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-on'style='color:blue' status='Active'></i>");
                }
            
            }, error: function(){
                alert("Error");
            }
        });
    });

    //Update Product Status
    $(document).on("click",".updateProductStatus", function(){
        var status = $(this).children("i").attr("status");product_id = $(this).attr("product_id")//.substring(5); //product-1
        // alert(product_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-status',
            data: {status:status, product_id:product_id}, 
            success: function(resp){
                if(resp['status']==0){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-on'style='color:blue' status='Active'></i>");
                }
            
            }, error: function(){
                alert("Error");
            }
        });
    });


    //Update Attribute Status
    $(document).on("click",".updateAttributeStatus", function(){
        var status = $(this).children("i").attr("status");attribute_id = $(this).attr("attribute_id")//.substring(5); //attribute-1
        // alert(attribute_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-attribute-status',
            data: {status:status, attribute_id:attribute_id}, 
            success: function(resp){
                if(resp['status']==0){
                    $("#attribute-"+attribute_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#attribute-"+attribute_id).html("<i class='fas fa-toggle-on'style='color:blue' status='Active'></i>");
                }
            
            }, error: function(){
                alert("Error");
            }
        });
    });

    //Update Banner Status
    $(document).on("click",".updateBannerStatus", function(){
        var status = $(this).children("i").attr("status");banner_id = $(this).attr("banner_id")//.substring(5); //banner-1
        // alert(banner_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-banner-status',
            data: {status:status, banner_id:banner_id}, 
            success: function(resp){
                if(resp['status']==0){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>");
                }else if(resp['status']==1){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-on'style='color:blue' status='Active'></i>");
                }
            
            }, error: function(){
                alert("Error");
            }
        });
    });


    //Confirm Deletion with SweetAlert
    $(document).on("click", ".confirmDelete", function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
              });
              window.location.href = "/admin/delete-"+record+"/"+recordid;
            }
          });
    })   


    
 //Add Product Attribute Script
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="sku[]" placeholder="SKU" style="width: 120px;" />&nbsp;<input type="text" name="size[]" placeholder="Size" style="width: 120px;" />&nbsp;<input type="text" name="uk_size[]" placeholder="Size(UK)" style="width: 120px;" />&nbsp;<input type="text" name="price[]" placeholder="Price" style="width: 120px;" />&nbsp;<input type="text" name="stock[]" placeholder="Stock" style="width: 120px;" />&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
    




    
})


