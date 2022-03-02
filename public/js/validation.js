function validate(array)
{
    var successFlag = true;
    for (var i = 0, l = array.length; i < l; i++) {
        var Id = array[i];
        $('.' + Id).each(function(i) {
            if ($(this).val() == '' || $(this).val() == 0) {
                successFlag = false;
                $(this).focus();
                $(this).css('border-color', 'red');

            } else {
                $(this).css('border-color', '');
            }
        });
    }
    if(successFlag == true)
    {
        $('form').submit();
    }
}
