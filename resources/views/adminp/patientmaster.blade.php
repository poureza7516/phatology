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

            <li><a href="#" onclick="hs('resultshow');"> نمایش نتیجه آزمایش  </a></li>

            <li><a href="#" onclick="hs('receptions');"> لیست سوابق آزمایشی </a></li>

        </ul>
    </div>

    <div class="content p-4">



        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}
        <script>
            var load=0;
            function hs(id)
            {
                document.getElementById('resultshow').style.display="none";
                document.getElementById('receptions').style.display="none";
                var x=document.getElementById(id);
                if (x.style.display === "none")
                {
                    x.style.display = "block";
                    load=1;
                } else {
                    x.style.display = "none";
                }
            }
        </script>
        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}
        <div style="font-family: 'B Nazanin'; font-size: medium;">
            {{--///////////////////////////////////////namayesh natije/////////////////////////////////////////////////////////////--}}

                <div class="content p-4 position-relative" style="top: 15%;left: 22%; height: auto;width: 50%;" id="resultshow">
                    <div class="card card-body">
                        <div class="card card-header">
                            <label>نمایش نتایج</label>
                        </div>
                        <hr>
                        <div class="card card-body">
                            <label>شماره پذیرش</label>
                            <input type="text" name="reception_id" id="receptionid">
                            <hr>
                            <button type="submit" class="btn btn-outline-info" onclick="ref('u');ref('testtableshow');u();">جستجو</button>
                            <hr>
                            <button type="submit" class="btn btn-outline-info" onclick="print();">چاپ</button>
                            <br>
                        </div>

                        <div  class="card card-body" id="printable">
                            <hr class="table-info">
                            <table  cellpadding="8"class="d-print-table-cell table-info " id="u">
                                <tr>
                                    <th >نام</th>
                                    <th >شماره ملی</th>
                                    <th >جنسیت</th>
                                    <th >تاریخ آزمایش</th>

                                </tr>
                                <tr >
                                    <td id="name"></td>
                                    <td id="national_id"></td>
                                    <td id="gender"></td>
                                    <td id="reception_date"></td>
                                </tr>
                            </table>
                               <hr class="table-info">
                            <table  cellpadding="8" class="d-print-table-cell table-info " id="testtableshow">
                                <tr>
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
                            <hr class="table-info">
                        </div>
                    </div>
                </div>


            {{--////////////////////////////////////show result//////////////////////////////////////////////////--}}




            {{--////////////////////////////js show tests function///////////////////////////////////////--}}
            <script>
                 var ID={{Auth::user()->id}}
                function showresult()
                {

                    var reception_id = document.getElementById('receptionid').value;
                    var url = 'http://localhost:8000/testindex?reception_id=' + reception_id;

                    fetch(url).then(res => res.json())
                        .then(data => {
                            var t = document.getElementById('testtableshow');
                            for (var d of data) {
                                t.innerHTML += "<tr><td>" + d['id'] + "</td><td>" + d['name'] + "</td><td>" + d['result'] + "</td><td>" + d['description'] + "</td></tr>";
                            }
                        })

                }


                function print()
                {
                    var content=document.getElementById('printable');
                    newWin= window.open("");
                    newWin.document.write(content.outerHTML);
                    newWin.print();
                    newWin.close();
                }

                function u()
                {
                    var reception_id = document.getElementById('receptionid').value;
                    var url = 'http://localhost:8000/userindex?reception_id=' + reception_id;
                    fetch(url).then(res=>res.json())
                        .then(data=>
                            {
                            var u = document.getElementById('u');
                            var id=data['1']['id'];
                            var userId=data['2']['user_id'];
                           var status=data['2']['status'];
                           var answer=data['2']['answer_date'];
                           if(userId==ID)
                           {
                            if(status=='ready')
                            {
                                u.innerHTML += "<tr><td>"+ data['1']['name'] + "</td><td>" + data['1']['national_id'] + "</td><td>"+data['1']['gender']+"</td><td>"+data['2']['reception_date']+"</td></tr>";

                                showresult();
                            }
                            else
                            {alert('نتیجه آزمایش در تاریخ'+answer+'در سامانه قرار میگیرد')}



                           }
                           else
                           {alert('شماره پذیرش وارد شده صحیح نمی باشد')}
                        }
                                       )


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

            {{--////////////////////////////js show tests function///////////////////////////////////////--}}


            {{----------------------show records ------------------------------------------------------------}}
            <div class="content p-4">
            <div class="position-relative" style="left: 18%;top:15%; display: none; height: auto;width: 50%;" id="receptions">
                <div  class="card card-body ">
                <div class="card card-header">
                        <label>سوابق آزمایشگاهی</label>
                    </div>
                    <div class="card card-body">
                        <button class="btn btn-outline-info" onclick="showRecords();">نمایش </button>
                    </div>
                    <hr>
                        <table cellpadding="8" class="d-print-table-cell table-info" id="recordtableshow">
                            <tr>
                                <th>شماره پذیرش</th>
                                <th >تاریخ انجام آزمایش</th>
                                <th >وضعیت</th>
                            </tr>
                            <tr >
                                <td id="id"></td>
                                <td id="reception_date"></td>
                                <td id="status"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                function showRecords()
                {
                    var url = 'http://localhost:8000/indexreceptions';

                    fetch(url).then(res=>res.json())
                        .then(data=>{
                            var t = document.getElementById('recordtableshow');
                            for ( var d of data ) {
                                t.innerHTML += "<tr><td>"+ d['id'] + "</td><td>" + d['reception_date'] + "</td><td>"+d['status']+"</td></tr>";
                            }
                        })
                }
                // window.onload=showRecords();
            </script>

            {{----------------------show records ------------------------------------------------------------}}



        </div>
    </div>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootadmin.min.js"></script>

</body>
</html>