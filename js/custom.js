function manage_wishlist(id, type){
    jQuery.ajax({
        url: 'manage_wishlist.php',
        type: 'post',
        data: 'id=' + id + '&type=' + type,
        success: function(result) {
            if(result == 'yes'){
                window.location.href = "login.php";
            }
            else if(result == "have"){
                alert("Already Added!");
            }
            else if(result == "success"){
                window.location.href = window.location.href;
            }
        }
    });
}
