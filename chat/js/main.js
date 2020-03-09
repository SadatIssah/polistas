$(document).ready(function() {
    $(".btn1 button").on("click", function() {

        var msg = $("#msg").val();

        var user1 = $("#user1").val();
        var user2 = $("#user2").val();

        var succ = $("#success").val();
        $.ajax({
            url: '../functions/process_msg.php',
            type: 'post',
            data: {
                msg_content: msg,
                username: user1,
                user_name: user2
            },
            success: function() {
                window.location.href = succ;
            }
        })


    });
});


function getContent() {
    return new Promise(function(resolve, reject) {

        var url = 'home.php';
        $.ajax({
            url: url,
            success: function(data) {
                resolve(data);
            },
            error: function(err) {
                reject(err);
            }
        });
    });

}