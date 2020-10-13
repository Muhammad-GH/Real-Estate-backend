$(' .file-select input[type=file]').change(function (e) {
    $(this).next().find(".filename").html(e.target.files[0].name).addClass("active");
    $(this).next().find(".clear").show();
});
$(" .file-select label span.clear").click(function (e) {
    e.preventDefault();
    $(this).prev(".filename").html("lataa tiedosto").removeClass("active");
    $(this).parents(".file-select").find("input[type=file]").val('');
    $(this).hide();
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#footer-newsletter').validate({ // initialize the plugin
        ignore: ":hidden",
        rules: {
            email_id: { required: true, email: true }
        },
        messages: {
            email_id: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' }
        },
        errorPlacement: function(error, element) {
            error.insertAfter('.invalid-feedback');
        },
        submitHandler: function (form) {
            $("#submit").html(loadingText);
            var email = $("input[name=email_id]").val();
            var url = $('#footer-newsletter').attr('action');
            $.ajax({
               type:'POST',
               url: url,
               data: {email:email},
               success:function(data){
                  $("#submit").html('Tilaa');
                  $('#msg').html(data.success);
                  if(data.success){
                      window.location.href = '/uutiskirje-kiitos'
                  }
               }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
});
// $(document).on('click','#submit',function(e){
//   $("#submit").html(loadingText);
//     e.preventDefault();
//     var email = $("input[name=email_id]").val();
//     var url = $('#footer-newsletter').attr('action');
//     $.ajax({
//        type:'POST',
//        url: url,
//        data: {email:email},
//        success:function(data){
//           $("#submit").html('Tilaa');
//           $('#msg').html(data.success);
//        }
//     });

// });