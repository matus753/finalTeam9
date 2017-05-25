function updateType(page) {
    var type = document.getElementById('ib-news-select').selectedIndex;
    var expired = document.getElementById('ib-news-chb').checked;
    page = typeof page !== 'undefined' ? page : 1;

    $.ajax({
        url: '../sk/news_generate.php',
        type: 'POST',
        data: {type: type, expired: expired, page: page},
        success: function (output) {
            document.getElementById('news-content').innerHTML = output;
        }
    });
}

function toggleExpired() {
    var page = document.getElementById('ib-active-page-button').value;
    var checked = document.getElementById('ib-news-chb').checked;
    if(checked){
        updateType(page);
    } else {
        updateType();
    }
}

$( document ).ready(function() {
    updateType();
});


function addNews() {
    // alert("button pressed");
    var date_expiration = document.getElementById('ib-modal-date').value;
    var type = document.getElementById('ib-modal-type').selectedIndex;
    var svk_title = document.getElementById('ib-modal-title-sk').value;
    var svk_content = document.getElementById('ib-modal-content-sk').value;
    var eng_title = document.getElementById('ib-modal-title-eng').value;
    var eng_content = document.getElementById('ib-modal-content-eng').value;

    // alert(date_expiration+"."+type+"."+svk_title+"."+svk_content+"."+eng_title+"."+eng_content+".");

    $.ajax({
        url: '../news_add.php',
        type: 'POST',
        data: {date: date_expiration,
            type: type,
            title_sk: svk_title,
            content_sk: svk_content,
            title_en: eng_title,
            content_en: eng_content},
        success: function (output) {
            alert(output);
            updateType();
        }
    });

}

function newsletter(bool) {
    var lang = document.getElementById('ib-newsletter-select').value;
    var email = document.getElementById('ib-newsletter-email').value;
    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
        $.ajax({
            url: '../sk/newsletter.php',
            type: 'POST',
            data: {bool: bool,
                lang: lang,
                email: email},
            success: function (output) {
                document.getElementById('ib-newsletter-modal-body').innerHTML = output;
            }
        });
    } else {
        alert("Chybny email");
    }
    // alert(bool+" "+lang+" "+email);

}

function newModal() {
    var newModal = true;
    $.ajax({
        url: '../sk/newsletter.php',
        type: 'POST',
        data: {newModal: newModal},
        success: function (output) {
            document.getElementById('ib-newsletter-modal-body').innerHTML = output;
        }
    });
}

function scroll() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
}
// $("button[href='#top']").click(function() {
//     $("html, body").animate({ scrollTop: 0 }, "slow");
//     return false;
// });
