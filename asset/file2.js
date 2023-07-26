alert("aaa");
$(function() {
  $('input[name="up[]"]').on("change",function(e){
    alert("aaa");
    let fs = this.files;
    $("#pics").html("");
    if(0 < fs.length){
      let fR = new FileReader();
      fR.onload = function(e){
        let src = e.target.result;
        $('<img>', { 'class':'picture', 'alt':fs[1].name, 'src': src,'width':"100px" }
         ).appendTo('#pics');
      }
      fR.readAsDataURL(fs[1]);
    }
  });
 })