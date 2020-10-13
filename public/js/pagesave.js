$(function() {

});

function savePageContent(pageContent){
   // console.log(pageContent);
    // const postData = new FormData();
    // postData.append( 'content', pageContent );

    $.ajax({
        url: siteBaseUrl+'/ajax/save-page-content',
        type:'post',
        data: {pageRoute: currentRoute, content: pageContent },
        success:function(response){
            var json = $.parseJSON(response);
            if ('Success' === json.status) {
                showToastNotification('success', json.message);
            }else{
                showToastNotification('error', json.message);
            }
            
        },
        error:function(){
            showToastNotification('error', 'Unable to save.');
        }
    });
}