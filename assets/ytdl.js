var yt_regex = new RegExp(/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=))([\w\-]{10,12})\b/);

$(function() {
    $('#btn_download').prop('disabled', false);
	$('#yt_uri').prop('disabled', false);
});

$("#btn_download").click(function() {
    var uri = $("#yt_uri").val();
    if (yt_regex.test(uri) != true) {
        alert("Please enter a valid YouTube video link!");
    } else {
        if (typeof grecaptcha == "object") {
            grecaptcha.execute();
        } else {
            downloadSubmit(null);
        }
    }
});

function downloadSubmit(token) {
    var uri = $("#yt_uri").val();
    $('#yt_uri').prop('readonly', true);
    $('#btn_download').prop('disabled', true).html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
    $.post("/ajax.php", {action: "download_mp3", recaptcha_token: token, yt_uri: uri}, (data) => {
        if (data.success) {
            location.replace('/download.php?q='+data.id+'&n='+data.name);

            if (typeof grecaptcha == "object") grecaptcha.reset();

            $('#btn_download').prop('disabled', false).html('Download MP3');
            $('#yt_uri').prop('readonly', false);
        } else {
            alert(data.error);

            if (typeof grecaptcha == "object") grecaptcha.reset();

            $('#btn_download').prop('disabled', false).html('Download MP3');
            $('#yt_uri').prop('readonly', false);
        }
    }, 'json');  
}