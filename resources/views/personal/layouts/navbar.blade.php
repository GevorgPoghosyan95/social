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
            <li class="nav-item active"><a class="nav-link" href="#" data-abc="true">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="/logout" data-abc="true">Logout</a></li>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-5">

                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item avatar dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="badge badge-danger ml-2">4</span>
                            <i class="fas fa-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
                             aria-labelledby="navbarDropdownMenuLink-5">
                            <a class="dropdown-item waves-effect waves-light" href="#">Action <span
                                    class="badge badge-danger ml-2">4</span></a>
                            <a class="dropdown-item waves-effect waves-light" href="#">Another action <span
                                    class="badge badge-danger ml-2">1</span></a>
                            <a class="dropdown-item waves-effect waves-light" href="#">Something else here <span
                                    class="badge badge-danger ml-2">4</span></a>
                        </div>
                    </li>
                </ul>
            </div>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input type="text" name="country" id="autocomplete"/>
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<script>
    $(document).ready(function () {

    })
    var source = [{
        value: "Spencer Kline",
        label: "Spencer Kline",
        link:"www.google.com"
    },
        {
            value: "James Bond",
            label: "James Bond",
            link:"www.google.com"
        },
    ];
    $('#autocomplete').autocomplete({
        source: source,
        select: function (event, ui) {
            window.location.href = ui.item.link;
        }
    });
</script>
