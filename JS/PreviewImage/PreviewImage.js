



function showPreview(input) {
  const file = event.target.files[0];
  console.log(file); // returns an object

  if (input.files && input.files[0]) {
    var filerdr = new FileReader();
    filerdr.onload = function (e) {
      $("#imgDisplayarea").attr("src", e.target.result);
    };
    filerdr.readAsDataURL(input.files[0]);
  }
}
