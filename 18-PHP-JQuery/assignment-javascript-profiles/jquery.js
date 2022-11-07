countPosition = 0;
$(document).ready(() => {
  $("#addPosition").click((e) => {
    e.preventDefault();
    if (countPosition >= 9) {
      // alert("Maximum of nine position entries exceeded !");
      $("#addPosition").hide();
      return;
    } else {
      $("#addPosition").show();
      countPosition++;
      $("#position-fields").append(
        '<div id="position-' +
          countPosition +
          '" >\
            <p>Year: \
                <input type="text" name="year' +
          countPosition +
          '" value="" />\
                <input type="button" value="-" onclick="$(\'#position-' +
          countPosition +
          '\').remove(); return false;">\
                </p>\
                <textarea name="description' +
          countPosition +
          '" rows="8" cols="80"></textarea>\
            </div> <br/>'
      );
    }
  });
});
