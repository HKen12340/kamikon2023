$(function() {
  $('.RegistRecipe_Iconform input[name="iconfile"]').change(function(e){
    let fs = this.files;
    $("#Iconpics").html("");
    if(0 < fs.length){
      let fR = new FileReader();
      fR.onload = function(e){
        let src = e.target.result;
        $('<img>', { 'width':'100px','height':'100px','class':'picture', 'alt':fs[0].name, 'src': src }
         ).appendTo('#Iconpics');
      }
      fR.readAsDataURL(fs[0]);
    }
  });
 })


$(function() {
  $('.RegistRecipe_Picform input[type=file]').after('<span></span>');
  // アップロードするファイルを複数選択
  $('.RegistRecipe_Picform input[type=file]').change(function() {
    $('span').html('');
    var file = $(this).prop('files');

    var img_count = 1;
    $(file).each(function(i) {
      // 5枚まで
      if (img_count > 5) {
        return false;
      }

      if (! file[i].type.match('image.*')) {
        $(this).val('');
        $('span').html('');
        return;
      }

      var reader = new FileReader();
      reader.onload = function() {
        var img_src = $('<img>',{'width':'100px','height':'100px','src':reader.result});
        $('span').append(img_src);
      }
      reader.readAsDataURL(file[i]);
      
      img_count = img_count + 1;
    });
  });
});
