function showFriendList(id) {
    $.post('/showFriends', {
        id: id,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function (response) {
        let html = '';
        $.each(JSON.parse(response), function (key, value) {
            html += `<a href="/showProfile/${value.id}"><div class="friends d-flex align-items-center">
                            <img class="img-xs rounded-circle"
                                 src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                            <div class="ml-2">
                                <p>${value.name} ${value.surname}</p>
                            </div>
                        </div></a><br>`
        })
        $('.col-md-8.col-xl-6.middle-wrapper').html(html)
    });
}


function sendRequest(status, sender_id, receiver_id) {
    $.post('/friendRequest', {
        status: status,
        sender_id: sender_id,
        receiver_id: receiver_id,
        _token: $('meta[name="csrf-token"]').attr('content')
    }, function (response) {
        if (response.status == 'ok') {
            window.location.reload()
        }
    });
}


$(document).ready(function () {
    $('input[name="people"]').keyup(function () {
        if ($(this).val().length > 2) {
            $.post('/find', {
                name: $(this).val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function (response) {
                let data = JSON.parse(response)
                let source = [];
                $.each(data, function (key, person) {
                    source.push({
                        label: person.name + ' ' + person.surname,
                        link: "/showProfile/" + person.id
                    })
                    $('#autocomplete').autocomplete({
                        source: source,
                        select: function (event, ui) {
                            window.location.href = ui.item.link;
                        }
                    });
                })
            });
        }
    })
})
