

function showFriendList(id) {
    $('#posts').hide()
    $('.friendsClass').addClass('active')
    $('.postClass').removeClass('active')
    $('.friendList').show();
    $('#friends').show();
}

function showPosts(id) {
    $('.friendList').hide();
    $('#friends').hide()
    $('.postClass').addClass('active')
    $('.friendsClass').removeClass('active')
    $('#posts').show();
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
    $('.friendList').hide();
    $('#newPost').click(function () {
        $('#myModal').modal('show');
    })
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

