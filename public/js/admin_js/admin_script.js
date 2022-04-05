$(document).ready(function() {
    //check if admin owd is correct or not
    $("#current_pwd").keyup(function() {
        var current_pwd = $('#current_pwd').val();
        //console.log(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: { current_pwd: current_pwd },
            success: function(resp) {
                // console.log(resp);
                if (resp === "false") {
                    $('#chkCurrentPwd').html("<font color=red>Current Password is incorrect</font>");
                } else if (resp === "true") {
                    $('#chkCurrentPwd').html("<font color=green>Current Password is correct</font>");
                }
            },
            error: function() {
                console.log('error');
            }
        })
    });

    $(".updateUserstatus").click(function() {
        var status = $(this).text();
        var user_id = $(this).attr('user_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-user-status',
            data: { status: status, user_id: user_id },
            success: function(resp) {
                //  alert(resp['status']);
                //   alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $("#user-" + user_id).html("<a class='updateUserstatus' href='javascript:void(0)'>Inactive</a");
                } else if (resp['status'] == 1) {
                    $("#user-" + user_id).html("<a class='updateUserstatus' href='javascript:void(0)'>Active</a");
                }
            },
            error: function(error) {
                alert(error);
            }
        })

    });

    // update category status

    $(".updateCategoryStatus").click(function() {
        var status = $(this).text();
        var category_id = $(this).attr('category_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function(resp) {
                // alert(resp['status']);
                //   alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $("#category-" + category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#category-" + category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>");
                }
            },
            error: function(error) {
                alert(error);
            }
        })

    });

    /* //confirm deletion of record
     $('.confirmDelete').click(function(){
         var name = $(this).attr("name");
         if (confirm("Are you sure to delete this "+name+"?")) {
             return true;
         } else{
             return false;
         }
     });*/

    //confirm Deletion with sweetAlert
    $('.confirmDelete').click(function() {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Are you sure you want to delete this ' + record + '?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }
        });

    });

    ///***** */
    // update product status

    $(".updateProductStatus").click(function() {
        var status = $(this).text();
        var product_id = $(this).attr('product_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },
            success: function(resp) {
                // alert(resp['status']);
                //   alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $("#product-" + product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#product-" + product_id).html("<a class='updateProductStatus' href='javascript:void(0)'>Active</a>");
                }
            },
            error: function(error) {
                alert(error);
            }
        });

    });

    //update attribute status
    $(".updateAttributeStatus").click(function() {
        var status = $(this).text();
        var attribute_id = $(this).attr('attribute_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-attribute-status',
            data: { status: status, attribute_id: attribute_id },
            success: function(resp) {
                // alert(resp['status']);
                //   alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $("#attribute-" + attribute_id).html("<a class='updateAttributeStatus' href='javascript:void(0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#attribute-" + attribute_id).html("<a class='updateAttributeStatus' href='javascript:void(0)'>Active</a>");
                }
            },
            error: function(error) {
                alert(error);
            }
        });

    });

    //update attribute status
    $(".updateImageStatus").click(function() {
        var status = $(this).text();
        var image_id = $(this).attr('image_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-image-status',
            data: { status: status, image_id: image_id },
            success: function(resp) {
                // alert(resp['status']);
                //   alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $("#image-" + image_id).html("<a class='updateImageStatus' href='javascript:void(0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#image-" + image_id).html("<a class='updateImageStatus' href='javascript:void(0)'>Active</a>");
                }
            },
            error: function(error) {
                alert(error);
            }
        });

    });

    //update brand status
    $(".updateBrandStatus").click(function() {
        var status = $(this).text();
        var brand_id = $(this).attr('brand_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },
            success: function(resp) {
                // alert(resp['status']);
                //   alert(resp['section_id']);
                if (resp['status'] == 0) {
                    $("#brand-" + brand_id).html("<a class='updateBrandStatus' href='javascript:void(0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#brand-" + brand_id).html("<a class='updateBrandStatus' href='javascript:void(0)'>Active</a>");
                }
            },
            error: function(error) {
                alert(error);
            }
        });

    });


    // products attributes Add/remove Script
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height:10px;"></div><input type="text" style="width:120px" placeholder="Size" id="size" name="size[]" value="" required/> <input type="text" style="width:120px" placeholder="SKU" id="sku" name="sku[]" value="" required/> <input type="number" style="width:120px" placeholder="Price" id="price" name="price[]" value="" required/> <input type="number" style="width:120px" placeholder="Stock" id="stock" name="stock[]" value="" required/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });


});
