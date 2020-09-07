$(document).ready(function(){

$("#imageFile").click(function (event) {
    $("#myModal").modal();
  })

  $('#myModal').on('hidden.bs.modal', function () {
    imgsrc = $("#imageFile").val();
    // alert(imgsrc);
    $("#previewImage").attr('src', imgsrc);
  })
});