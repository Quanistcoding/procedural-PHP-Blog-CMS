
$(document).ready(function() {
    $('#post_content').summernote({
        height:"200px"
    });

    $("#selectAllCheckbox").click(function(){
        if(this.checked){
            $(".checkboxes").each(function(){
                this.checked = true;
            })
        }else{
            $(".checkboxes").each(function(){
                this.checked = false;
            })
        }
    })
});

