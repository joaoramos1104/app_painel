// painel index
setInterval(function () {
    $.ajax({
        url: '/listar_pedido_separacao',
        type: "POST",
        success: function (data) {
            dados = $.parseJSON(data);
            var itens = "";
            $.each(dados, function (key, value) {
                itens += '<div class="col">';
                itens += '<div class="border bg-light shadow rounded-pill mt-1">' + value.numero_pedido + '</div>';
                itens += '<div>';

            })
            $("#separacao").empty(itens).append(itens);
        }
    });

}, 2000);

setInterval(function () {
    $.ajax({
        url: '/listar_pedido_retirada',
        type: "POST",
        success: function (data) {
            dados = $.parseJSON(data);
            var itens = "";
            $.each(dados, function (key, value) {
                itens += '<div class="col">';
                itens += '<div class="border bg-light shadow rounded-pill mt-1">' + value.numero_pedido + '</div>';
                itens += '<div>';
            })
            $("#retirada").empty(itens).append(itens);
        }
    });
}, 2000);


//Audio

// setInterval(function () {
//     var audio = document.getElementById('audio')
//     audio.volume = 1;
//     audio.play()
// }, 1500)

$(document).ready(function () {
        $.ajax({
            url: '/listar_video',
            success: function (data) {
                dados = $.parseJSON(data);
                var video = "";
                $.each(dados, function (key, value) {

                    video += '<video id="media" width="100%" height="auto" autoplay loop muted>';
                    video += '<source src="video/' + value.descricao_video + '" type="video/mp4" />';
                    video += '</video>';

                })
                $("#video").empty(video).append(video);
                setInterval(function () {
                    $("#video").empty(video).append(video);
                },90000);
            }
        });

});
$(document).ready(function () {
    $.ajax({
        url: '/logo',
        success: function (data) {
            dados = $.parseJSON(data);
            var logo = "";
            $.each(dados, function (key, value) {
                logo += '<img src="img/' + value.logo + '" alt="Pro" class="mb-3" width="200px" height="150px"></img>';
            })
            $("#logo, #logo_media").empty(logo).append(logo);
            setInterval(function () {
                $("#logo, #logo_media").empty(logo).append(logo);
            },90000);
        }
    });

});

//time
var myVar = setInterval(myTimer, 1000);
function myTimer() {
    var d = new Date(), displayDate;
    if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
        displayDate = d.toLocaleTimeString('pt-BR');
    } else {
        displayDate = d.toLocaleTimeString('pt-BR', { timeZone: "America/Sao_Paulo" });
    }
    document.getElementById("dateTime").innerHTML = displayDate;
}