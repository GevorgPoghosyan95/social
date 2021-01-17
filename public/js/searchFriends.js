$(document).ready(function () {
    $('input[name="friends"]').keyup(function () {
        if ($(this).val().length > 2) {
            $('#friends').hide()
            $.post('/findFriends', {
                id:user,
                name: $(this).val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function (response) {
                let data = JSON.parse(response)
                let html = '';
                $.each(data,function (key,friend) {
                    html += `<a href="/showProfile/${friend.id}" style="padding-top: 10px">
                                <div class="friends d-flex align-items-center">
                                    <img class="img-xs rounded-circle"
                                         src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                    <div class="ml-2">
                                        <p>${friend.name} ${friend.surname}</p>
                                    </div>
                                </div>
                            </a>`
                })
                $('#foundedFriends').html(html)
            });
        }else{
            $('#friends').show()
            $('#foundedFriends').html('')
        }
    })
})
