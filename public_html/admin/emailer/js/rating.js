<script>
$(document).ready(function(){
    
    // Check Radio-box

    $(".rating input:radio").attr("checked", false);
    $( "#str5" ).prop( "checked", true );

    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });

    $('.rating input:radio').change(
      function(){

        userRating = this.value;
        alert(userRating);
    }); 
});
</script>