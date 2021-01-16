<style>
    .autocomplete-suggestions {
        border: 1px solid #999;
        background: #FFF;
        overflow: auto;
    }

    .autocomplete-suggestion {
        padding: 2px 5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .autocomplete-selected {
        background: #F0F0F0;
    }

    .autocomplete-suggestions strong {
        font-weight: normal;
        color: #3399FF;
    }

    .autocomplete-group {
        padding: 2px 5px;
    }

    .autocomplete-group strong {
        display: block;
        border-bottom: 1px solid #000;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation"><span
            class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="{!! route('personal') !!}" data-abc="true">Home <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="/logout" data-abc="true">Logout</a></li>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-5">
                @if(Auth::user()->receivedRequests()->count())
                    <ul class="navbar-nav ml-auto nav-flex-icons" style="padding-left: 100px">
                        <li class="nav-item avatar dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span
                                class="badge badge-danger ml-2">{!! Auth::user()->receivedRequests()->count() !!}</span>
                                <i class="fas fa-bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
                                 aria-labelledby="navbarDropdownMenuLink-5">
                                @foreach(Auth::user()->receivedRequests as $user)
                                    <a class="dropdown-item waves-effect waves-light"
                                       href="#">{!! $user->name.' '.$user->surname !!}
                                        <span class="badge badge-primary ml-2"
                                              onclick="sendRequest('approved',{{$user->id}},{{Auth::user()->id}})">Accept</span>
                                        <span class="badge badge-danger ml-2"
                                              onclick="sendRequest('rejected',{{$user->id}},{{Auth::user()->id}})">Cancel</span></a>
                                @endforeach

                            </div>
                        </li>
                    </ul>
                @endif
            </div>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input type="text" name="people" id="autocomplete" value=""/>
        </form>
    </div>
</nav>

<script>
    function sendRequest(status, sender_id, receiver_id) {
        $.post('{{ route('friendRequest') }}', {
            status: status,
            sender_id: sender_id,
            receiver_id: receiver_id,
            _token: '{{ csrf_token() }}'
        }, function (response) {
            if (response.status == 'ok') {
                window.location.reload()
            }
        });
    }


    $(document).ready(function () {
        $('input[name="people"]').keyup(function () {
            if ($(this).val().length > 2) {
                $.post('{{ route('find') }}', {
                    name: $(this).val(),
                    _token: '{{ csrf_token() }}'
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
</script>
