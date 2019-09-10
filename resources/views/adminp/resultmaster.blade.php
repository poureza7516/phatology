<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta style="font-family: 'B Nazanin'; font-size: medium;">
{{---------------------------------------------------------------------------------------------------------------------------}}
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/bootadmin.min.css">

    <title>pathology</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"></a>
    <a class="navbar-brand" href="#">کاربر گرامی خوش آمدید</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            {{--<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>--}}
            {{--<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li>--}}
            {{---------------/////////------///////////////////////////////////////////////////////////////////////////--}}
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        {{-----------comentesh kardam k gozine register az safhe log in bre------------------ --}}
                        {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{-----------comentesh kardam k gozine register az safhe log in bre------------------ --}}

                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            {{---------------/////////------///////////////////////////////////////////////////////////////////////////--}}

        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">

            <li><a href="#" onclick="hs('reg');"> ثبت نتیجه آزمایش </a></li>
            <li><a href="#" onclick="hs('sh');"> دریافت نتیجه آزمایش  </a></li>
            <li><a href="/employeehome"> پذیرش</a>
            <li><a href="/phatologysts"> تازه سازی</a>
        </ul>
    </div>

    <div class="content p-4">



        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}
        <script>
            function hs(id)
            {
                document.getElementById('reg').style.display="none";
                document.getElementById('sh').style.display="none";
                var x=document.getElementById(id);
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}

        {{--////////////////////////////////////////////////////reg results///////////////////////////////////////////////////////////////////////--}}

        <div class=" position-relative" style="top: 3%;left: 22%; height: auto;width: 50%;" id="reg">

            <div class="card card-body">
                <div class="card-header">ثبت نتایج</div>
                <hr>
                <div class="card card-body">
                    <label>شماره پذیرش را وارد کنید</label>
                    <input type="text" name="reception_id" id="reception-id">
                    <input id="csrf" type="hidden" name="__token" value={{csrf_token()}} >
                    <hr>
                    <button type="submit" class="btn btn-outline-info" onclick="ref('testtable');reception();">جستجو</button>
                </div>

                <div  class="card card-text" id="refdiv">

                    <table id="testtable" class="table table-info">
                        <tr >
                            <th>شماره</th>
                            <th>نام</th>
                            <td>نتیجه</td>
                            <td>توضیحات</td>

                        </tr>
                        <tr>
                            <td id="id"></td>
                            <td id="name"></td>
                        </tr>
                    </table>
                </div>

                <div class="card card-footer">
                    <hr>
                    <button class="btn btn-outline-info" id="status" onclick="st();">قابل مشاهده برای بیمار</button>
                </div>
            </div>
<script>
    function st()
    {
        var receptionid = document.getElementById('reception-id').value;

        var url = 'http://localhost:8000/statuschange?id='+receptionid;
        fetch(url);
    }

    function ref(id)
    {
        var table=document.getElementById(id);
        for(var i = table. rows. length - 1; i > 0; i--)
        {
            table. deleteRow(i);
        }
    }
</script>



        </div>
        {{--/////////////////////////////////////////////////reg results///////////////////////////////////////////////////////////////////////////--}}


        {{--/////////////////////////////////////////////////show results///////////////////////////////////////////////////////////////////////////--}}
        {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

        <div class="content p-4">
            <div class=" position-relative" style="top: 3%;left: 22%; height: auto;width: 50%;display: none;" id="sh">
                <div class="card card-body">
                    <div class="card card-header">
                        <label>نمایش نتایج</label>
                    </div>
                    <hr>
                    <div class="card card-body">
                        <label>شماره پذیرش</label>
                        <input type="text" name="reception_id" id="receptionid">
                        <hr>
                        <button type="submit" class="btn btn-outline-info" onclick="ref('u');ref('testtableshow');showresult();u();">جستجو</button>
                    </div>

                    <div  class="card card-text" id="p">
                          <hr class="table-info">
                        <table  cellpadding="8" class="d-print-table-cell table-info" id="u">
                            <thead style="background-color: #7918f2">
                                <th >نام</th>
                                <th>شماره ملی</th>
                                <th >جنسیت</th>
                                <th >تاریخ آزمایش</th>
                            </thead>
                            <tr>
                                <td id="name"></td>
                                <td id="national_id"></td>
                                <td id="gender"></td>
                                <td id="reception_date"></td>
                            </tr>
                        </table>
                                     <hr>
                        <table cellpadding="8" class="d-print-table-cell table-info"  id="testtableshow">
                            <tr style="background-color: #7918f2">
                                <th>شماره</th>
                                <th >نام</th>
                                <th >نتیجه</th>
                                <th >توضیحات</th>
                            </tr>
                            <tr >
                                <td id="id"></td>
                                <td id="name"></td>
                                <td id="result"></td>
                                <td id="description"></td>
                            </tr>
                        </table>
                        <hr>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-outline-info" onclick="print();">چاپ</button>
                </div>
            </div>
        </div>
        <script>
            function print()
            {
                var content=document.getElementById('p');
                newWin= window.open("");
                newWin.document.write(content.outerHTML);
                newWin.print();
                newWin.close();
            }

        </script>

        <script>
            function reception()
            {
                var reception_id = document.getElementById('reception-id').value;

                var url = 'http://localhost:8000/testsearch?reception_id=' + reception_id;
                fetch(url).then(res=>res.json())
                    .then(data=>{
                        var t = document.getElementById('testtable');
                        for ( var d of data ) {
                            t.innerHTML += "<tr><td>"+ d['id'] + "</td><td>" + d['name'] + "</td><td><input type='text' id='result"+d['id'] +"'/></td><td><input type='text' id='description" + d['id'] +"'/</td>"
                                +"<td><button class='btn btn-outline-info' onclick='submittest(" + d['id']+")'>save</button></td></tr>";
                        }
                    })
            }
        </script>

        {{--------------------------------------------------------js show result --------------------------------------------}}

        <script>
            function showresult()
            {
                var reception_id = document.getElementById('receptionid').value;
                var url = 'http://localhost:8000/testindex?reception_id=' + reception_id;
                fetch(url).then(res=>res.json())
                    .then(data=>{
                        var t = document.getElementById('testtableshow');
                        for ( var d of data ) {
                            t.innerHTML += "<tr><td>"+ d['id'] + "</td><td>" + d['name'] + "</td><td>"+d['result']+"</td><td>"+d['description']+"</td></tr>";
                        }
                    })

            }
            function u()
            {
                var reception_id = document.getElementById('receptionid').value;
                var url = 'http://localhost:8000/userindex?reception_id=' + reception_id;
                fetch(url).then(res=>res.json())
                    .then(data=>{
                        var u = document.getElementById('u');
                            u.innerHTML += "<tr><td>"+ data['1']['name'] + "</td><td>" + data['1']['national_id'] + "</td><td>"+data['1']['gender']+"</td><td>"+data['2']['reception_date']+"</tr>";

                    })
            }
        </script>

        {{---------------------------------------------------------------------------------------------------------------}}
        <script>
            function submittest(id) {
                var result = document.getElementById('result' + id).value;
                var description = document.getElementById('description'+id).value;
                var url = 'http://localhost:8000/updatetest';
                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify({id: id, result: result, description: description}),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        "X-CSRF-Token": document.getElementById('csrf').value
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        alert( 'ثبت شد' );
                    })
            }
        </script>
        {{--------------------------------------------------------js show result --------------------------------------------}}


        {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}
        {{--/////////////////////////////////////////////////show results///////////////////////////////////////////////////////////////////////////--}}

    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootadmin.min.js"></script>

</body>
</html>