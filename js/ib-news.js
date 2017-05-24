function updateType() {
    var type = document.getElementById('ib-news-select').selectedIndex;
    // alert(type);
    $.ajax({
        url: 'news_generate.php',
        type: 'POST',
        data: {type: type},
        success: function (output) {
            document.getElementById('news-content').innerHTML = output;
        }
    });
}

$( document ).ready(function() {
    updateType();
});

function showExpired() {
    var value = document.getElementById('ib-news-chb').checked;
    // alert(value);
    if(value == true){
        $('.ib-expired').css('display', 'block');
    } else {
        $('.ib-expired').css('display', 'none');
    }
}