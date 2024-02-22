$(function()
{$('#upload').change(function () {
  console.log($(this)[0].files)
})})
$(function()
{$('#upload').change(function () {
  const file = $(this)[0].files[0]
  const fileReader = new fileReader()
  fileReader.onLoadend = function () {
    console.log(fileReader.result)
  }
  fileReader.readAsDataURL(file)
})})
$(function(){
    $('#upload').change(function(){
        const file = $(this)[0].files[0]
        const fileReader = new fileReader()
        fileReader.onLoadend = function(){
            $('#img')attrib('src', .fileReader.result)
        }
        fileReader.readAsDataURL(file)
    })
})