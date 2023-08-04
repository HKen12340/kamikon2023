$(function() {
  $('input[type=file]').after('<span></span>');

  // アップロードするファイルを複数選択
  $('input[type=file]').change(function() {
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