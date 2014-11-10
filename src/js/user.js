/**
 * for user mgmt
 */
(function($){
$(document).ready(function () {
    $("i.name").click(function(){
        $("form.form-horizontal").remove();
        $("button.btn-danger").remove();
        $("div.user-info").append("<form class='form-horizontal' role='form' action='php/accountmgr.php' method='post'><div class='form-group col-sm-9'><input type='text' class='form-control input-lg' name='user_name' placeholder='New Name' id='name'></div><div class='form-group col-sm-3'><button type='submit' class='btn btn-default btn-success btn-lg'>Update</button></div></form>");
        $("div.user-info").append("<div><button type='button' class='btn btn-danger btn-lg'>Cancel</button></div>");
        $("input#name").focus();
    });

    $("i.zipcode").click(function(){
        $("form.form-horizontal").remove();
        $("button.btn-danger").remove();
        $("div.user-info").append("<form class='form-horizontal' role='form' action='php/accountmgr.php' method='post'><div class='form-group col-sm-9'><input type='number' class='form-control input-lg' name='zip_code' placeholder='New Zipcode' id='zip_code'></div><div class='form-group col-sm-3'><button type='submit' class='btn btn-default btn-success btn-lg'>Update</button></div></form>");
        $("div.user-info").append("<div><button type='button' class='btn btn-danger btn-lg'>Cancel</button></div>");
        $("input#zip_code").focus();
    });

    $("i.email").click(function(){
        $("form.form-horizontal").remove();
        $("button.btn-danger").remove();
        $("div.user-info").append("<form class='form-horizontal' role='form' action='php/accountmgr.php' method='post'><div class='form-group col-sm-9'><input type='email' class='form-control input-lg' name='email' placeholder='New Email' id='email'></div><div class='form-group col-sm-3'><button type='submit' class='btn btn-default btn-success btn-lg'>Update</button></div></form>");
        $("div.user-info").append("<div><button type='button' class='btn btn-danger btn-lg'>Cancel</button></div>");
        $("input#email").focus();
    });

    $("i.password").click(function(){
        $("form.form-horizontal").remove();
        $("button.btn-danger").remove();
        $("div.user-info").append("<span></span><form class='form-horizontal' role='form' action='php/accountmgr.php' method='post'><div class='form-group'><input type='password' class='form-control input-lg' name='old_pw' placeholder='Current Password' id='old_pw' required='required'></div><div class='form-group pw'><input type='password' class='form-control input-lg' name='new_pw1' placeholder='New Password' id='new_pw1' required='required'></div><div class='form-group pw'><input type='password' class='form-control input-lg' name='new_pw2' placeholder='Confirm New Password' id='new_pw2' required='required'></div><div class='form-group col-sm-4'><button type='submit' class='btn btn-default btn-success btn-lg'>Update</button></div></form>");
        $("div.user-info").append("<div><button type='button' class='btn btn-danger btn-lg'>Cancel</button></div>");
        $("input#old_pw").focus();
    });
    
    $("div.user-info").on("click","button.btn-danger",function(){
        $("form").remove();
        $("span").remove();
        $(this).remove();
    });

    $("div.user-info").on("focusout","input#old_pw",function(){
        console.log("hello");
        /*console.log($("input#new_pw2").val());

        if ($("input#new_pw1").val() != $("input#new_pw2").val()){
            console.log("passwords don't match");
            $("span").text("<h5 class='text-danger text-center'>Your new passwords do not match.<br>Please try again.</h5>").show();
        }*/
        
    });

    $("div.user-info").on("focusout","input#new_pw2",function(){
        var pass1 = $("input#new_pw1").val(); 
        var pass2 = $("input#new_pw2").val();
        //console.log(pass1);
        //console.log(pass2);
        
        if (pass1 != pass2){
            console.log("passwords don't match");
            $("span").append("<h5 class='text-danger text-center'>Your new passwords do not match.<br>Please try again.</h5>");
            $("div.pw").addClass("has-error");
        }
    });
    
});

})(jQuery);