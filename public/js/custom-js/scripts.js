// notification
function notification (title, message, template){
    function notify(from, align, icon, type, animIn, animOut){
        $.growl({
            title: title,
            message: message,
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: "top",
                align: "right"
            },
            offset: {
                x: 20,
                y: 85
            },
            spacing: 10,
            z_index: 2031,
            delay: 2500,
            timer: 5000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: template
        });

    };

    $( function(){
        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nIcons = $(this).attr('data-icon');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');

        notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    });
}


// Novo Pedido
$('#novo-pedido').submit(function (e) {
    e.preventDefault()
    url = $(this).attr("action")
    $.ajax({
        data: $(this).serialize(),
        url: url,
        type: 'post',
        dataType: 'json',

        success: function (response) {
            console.log('response')
            $('[data-name="form-novo-pedido"]').val('');


            title = ' <i class="bi bi-check2-square"></i> '
            message = 'Novo Pedido inserido, em separação!'
            template =
                '<div class="alert alert-info bg-info" role="alert">' +
                '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                '</div>'

                notification(title, message, template)

                // $('#modal').load(' #modal');
            $("#pedidosSeparacao").load( "/controle #pedidosSeparacao");
            $("#modal").load( "/controle #modal");

            
        },

        error: function (response) {
            console.log('erro')
            title = ' <i class="bi bi-exclamation-circle"> </i> '
            message = response.responseJSON.message
            template =
                '<div class="alert alert-danger bg-danger" role="alert">' +
                '<strong data-growl="title"></strong> <span data-growl="message"></span>' +
                '</div>'

            notification(title, message, template)

        }
    })
})


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

}, 3000);


// Audio

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


//mask telefone
function mask(o) {
    setTimeout(function() {
        var v = mphone(o.value);
        if (v != o.value) {
            o.value = v;
        }
    }, 1);
}

function mphone(v) {
    var r = v.replace(/\D/g, "");
    r = r.replace(/^0/, "");
    if (r.length > 10) {
        r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (r.length > 5) {
        r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (r.length > 2) {
        r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
        r = r.replace(/^(\d*)/, "($1");
    }
    return r;
}
