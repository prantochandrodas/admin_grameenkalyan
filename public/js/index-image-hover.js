const smileCircle = document.getElementById("smileCircle");
$(".smile-list-item-hover-effect").mouseover(function(){
    var image = $(this).attr('image'); 
    smileCircle.style.backgroundImage = "url('"+image+"')"
  });

