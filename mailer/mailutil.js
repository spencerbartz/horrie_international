$(function() {
    if($('#bcc_input').val().length > 0) {
        $('#bcc_input').show();
        $('#bcc_checkbox').val("yes");
        $('#bcc_checkbox').prop('checked', true);
    }
    else
    {
        $('#bcc_input').hide();
        $('#bcc_checkbox').val("no");
        $('#bcc_checkbox').prop('checked', false);
    }
    
    $('#mail_form').submit(function(e) {
        e.preventDefault(); 
        var formData = $("#mail_form :input");
        
        formData = _.filter(formData, function(item) {
            return item.id !== "submit";
        });
        
        formDict = {};
        
        _.each(formData, function(item) {
            formDict[item.id] = item.value;
        });
        
        console.log(formDict);
        
        sendMail(formDict);
    });
    
    $('#bcc_checkbox').change(function(e) {
        if($(this).val() === "no")
        {
            $('#bcc_input').show();
            $(this).val("yes");
        }
        else
        {
            $('#bcc_input').hide();
            $(this).val("no");
        }
    });
});


function sendMail(formDict) {
    $.ajax({
      method: "POST",
      url: "sendmail.php",
      data: formDict
    })
    .done(function(msg) {
        alert(msg);
        console.log(msg);
        
        if(msg.indexOf("ERROR:") < 0) {
            $("#mail_form")[0].reset();
            $('#bcc_input').hide();
            $('#bcc_checkbox').val("no");
        }
        
    })
    .fail(function() {
        alert("ERROR: Horrie Mailer was unable to send the email");
    });
}