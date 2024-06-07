// $(document).ready(function(){
//     $("#orderby").on('change', function(){
//         this.form.submit();
//     })
// });


function setColorFilter(color) {
    document.getElementById('colorInput').value = color;
    document.getElementById('filterForm').submit(); // Change to 'filterForm'
}

function setSizeFilter(size) {
    console.log('Size selected:', size); // Add this line to check if the function is invoked
    document.getElementById('sizeInput').value = size;
    document.getElementById('filterForm').submit(); // Change to 'filterForm'
}


$(document).ready(function () {
    $(".getPrice").change(function () {
        document.getElementById('product-to-cart').disabled = false;
        var size = $(this).val(); // Correct usage of $(this)
        var product_id = $(this).attr('product-id'); // Correct usage of $(this)
        // alert("product_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-attribute-price',
            type: 'post', // Ensure there's a comma before this line
            data: { size: size, product_id: product_id }, // Correct the order and ensure it's an object
            success: function (resp) {
                // alert(resp);                

                console.log("size and price result: " + JSON.stringify(resp));

                document.getElementById('stock-qty').innerText = 'Only ' + resp.stock + ' left in stock';
                document.getElementById('finale-price').innerText = 'LKR ' + resp.price;

                //uncomment below 2 lines to change progress bar.
                var newprogress = 'progress-bar w-' + resp.stock;
                $('#progress-bar').attr('aria-valuenow', resp.stock).removeClass().addClass(newprogress);
            },
            error: function (err) {
                console.log("AJAX error in request: " + JSON.stringify(err));
            }
        });
    });


    //Add to Cart
    // $("#addToCart").submit(function () {
    //     var formData = $(this).serialize();
    //     console.log("before: " + JSON.stringify(formData));
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: '/add-to-cart',
    //         type: 'post',
    //         data: formData,
    //         success: function (resp) {
    //             console.log("Add to cart result: " + JSON.stringify(resp));
    //             if (resp.status == false) {
    //                 alert(resp.message);
    //             }
    //         },
    //     })
    // })



    //Update Cart Items Quantity
    $(document).on('click', '.updateCartItem', function () {
        var quantity = $(this).siblings('input').val();
        // console.log(quantity);

        var cartid = $(this).data('cartid');
        var newData = {
            cart_id: cartid,
            quantity: quantity
        }
        // console.log("newData" + JSON.stringify(newData));
        var newClassname = 'input-qty-cart-' + cartid;
        var price = document.getElementById(newClassname).getAttribute('data-unitPrice');
        var priceColumn = 'finale-price-per-product-' + cartid;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post', // Ensure there's a comma before this line

            data: newData,
            url: 'update-cart-item-qty',  // Ensure this route matches the one defined in web.php

            success: function (resp) {
                // console.log("Update cart result: " + JSON.stringify(resp));
                // console.log("price", price);
                let newPrice = parseFloat(quantity * price);
                document.getElementById(newClassname).setAttribute("data-qty", quantity);
                document.getElementById(priceColumn).innerText = newPrice.toFixed(2);
                var targetDivs = document.getElementsByClassName("product-price");
                var totalValue = 0;

                for (var i = 0; i < targetDivs.length; i++) {
                    var divText = targetDivs[i].textContent;
                    console.log("elements", divText);
                    // Assuming the text content represents numeric values
                    var numericValue = parseFloat(divText); // Convert to a numeric value
                    totalValue += numericValue;
                }
                document.getElementById('sub-total').innerText = Number(totalValue).toFixed(2);//.toFixed(2);
                console.log('Total value:', totalValue);

            },
            error: function (e) {
                console.log(JSON.stringify(e));
            }
        });
    });

    $(document).on('click', '#delete-cart-item', function () {
        console.log('cart', $(this).data('cartid'));
        var cartid = $(this).data('cartid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'delete-cart-item',
            type: 'post',
            data: { cart_id: cartid },
            success: function (resp) {
                if (resp.status == true) {
                    location.reload();
                }
                //console.log(resp);
                // $('#appendCartItems').html(resp.view);
            },
            error: function (e) {
                console.log(JSON.stringify(e));
            }
        });
    });



    // Register Form Validation
    $("#registerForm").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission
        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/register',
            type: 'POST',
            data: formData,
            success: function (resp) {
                if (resp.status === false && resp.type === "validation") {
                    $.each(resp.errors, function (i, error) {
                        $('#register-' + i).css('color', 'red');
                        $('#register-' + i).html(error);
                        setTimeout(function () {
                            $('#register-' + i).css('display', 'none');
                        }, 3000);
                    });
                } else {
                    window.location.href = resp.url;
                }
            },
            error: function () {
                alert("An error occurred. Please try again.");
            }
        });
    });



//     //Save Delivery Address
//     $("#deliveryAddressForm").submit(function (event) {
//        // event.preventDefault();
//    // $(document).on('click', '#deliveryForm', function () {
//         $(".loader").show();
//         console.log("add button clicked");
//         var formData = $(this).serialize();
//         console.log("formData", formData);
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             url: '/save-delivery-address',
//             type: 'post',
//             data: formData,
//             success: function (resp) {
//                 console.log("resp", resp);
//                 // if (resp.typr == error) {
//                 //     $(".loader").hide();
//                 //     $each(resp.errors, function (i, error) {
//                 //         $('#delivery-' + i).attr('style', 'color:red');
//                 //         $('#delivery-' + i).html(error);
//                 //         setTimeout(function () {
//                 //             $('#delivery-' + i).css('display', 'none');
//                 //         }, 3000);
//                 //     });
//                 // } else {
//                 //     $("#deliveryAddresses").html(resp.view);
//                 // }
//             },
//             error: function () {
//                 alert("An error occurred. Please try again.");
//             }
//         });
//     });








});


// document.getElementById('quantity').onchange = function () {
//     if (this.value < 1) {
//         this.value = 1;
//     }

// }

















