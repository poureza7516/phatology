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
    <a class="navbar-brand" href="#">مدیریت گرامی خوش آمدید</a>

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

            <li><a href="#" onclick="hs('user');"> جستجو کارمند  </a></li>
            <li><a href="/register"> افزودن کارمند جدید </a></li>
            <li><a href="#" onclick="hs('delete');"> حذف کاربر </a></li>
            <li><a href="#" onclick="hs('report');">    گزارش </a></li>

        </ul>
    </div>

    <div class="content p-4">



        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}
        <script>
            function hs(id)
            {
                document.getElementById('user').style.display="none";
                document.getElementById('report').style.display="none";
                var x=document.getElementById(id);
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}

        {{--///////////////////////////////////////search employeee////////////////////////////////////////////////--}}
        <div class=" position-relative" style="top: 15%;left: 22%; height: auto;width: 50%;" id="user">
            <div class="content p-4">
                <div class=" card card-body">
                    <input id="csrf" type="hidden" name="__token" value={{csrf_token()}} >
                    {{csrf_field()}}
                    <div class="card-header">جستجو کارمند</div>
                    <hr>
                    <label>کد ملی :</label>
                    <input id="national_id" type="text" name="national_id" class="form-control" required />
                    <button id="search" type="submit" class="btn btn-outline-info" onclick="ss()">Search</button>
                    <hr>


                    <div  class="card card-text">

                        <table class="table table-info table-striped">
                            <tr>
                                <th>شماره</th>
                                <th >نام</th>
                                <th >تلفن</th>
                                <th >جنسیت</th>
                            </tr>
                            <tr >
                                <td id="id"></td>
                                <td id="name"></td>
                                <td id="phone"></td>
                                <td id="gender"></td>
                            </tr>
                        </table>
                        <button id="edit" type="submit" class="btn btn-outline-secondary"  onclick="del();">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        {{--/////////////////////////////////js search function ///////////////////////////////////////////////////--}}

        <script>
            function ss() {
                var national = document.getElementById('national_id').value;
                const url = 'http://localhost:8000/employeehome/search?national_id=' + national;
                console.log(url);
                fetch(url)
                    .then(function(res) {
                        return res.json()
                    })
                    .then(function(data) {

                            ////////////////////////////////////////////////
                            document.getElementById('id').innerHTML = data.id;
                            document.getElementById('name').innerHTML = data.name;
                            document.getElementById('phone').innerHTML = data.phone;
                            document.getElementById('gender').innerHTML = data.gender;
                            document.getElementById('national-id').innerHTML = data.national_id;
                            ////////////////////////////////////////////////
                        if (data.type =='employee')
                        {
                        }
                        else {
                            alert('شماره ملی'+'"'+national+'"'+ 'مربوط به کارمندان نیست');
                        }

                    }, err=>alert('کاربر '+'"'+national+'"'+' یافت نشد'))


            }
        </script>

        {{--/////////////////////////////////js search function ///////////////////////////////////////////////////--}}


        {{--///////////////////////////////////////search employeee////////////////////////////////////////////////--}}


        {{--///////////////////////////////////////////////////////////delete user///////////////////////////////////////////////////--}}
        <script>
            function del()
            {
                var national = document.getElementById('national_id').value;
                var w=window.confirm('از حذف کاربر '+national+'اطمینان دارید؟');
                var url = 'http://localhost:8000/userdelete?national_id=' + national;
                if (w)
                {
                  fetch(url);
                   alert('کاربر با موفقیت حذف شد');
                }
            }
        </script>

        {{--///////////////////////////////////////////////////////////delete user///////////////////////////////////////////////////--}}

        {{--////////////////////////////////////////////reporting////////////////////////////////////////////////////////--}}
        <div class=" position-relative" style="top: 15%;left: 22%; height: auto;width: 50%;display: none;" id="report">
            <div class="card card-body">
                <div class="card-header">
                    <label>گزارش گیری</label>
                </div>
                <div class="card-body">
                    <label for="start">تاریخ شروع</label>
                    <input type="date" name="start" id="start">
                    <label for="end">تاریخ پایان</label>
                    <input type="date" name="end" id="end">
                </div>
                <select id="type">
                    <option value="earning">درآمد کل ماه</option>
                    <option value="testsum">کل پذیرش های انجام شده</option>
                </select>
                <hr>
                <button type="submit" class="btn btn-outline-info" onclick="report();">OK</button>
            </div>
        </div>

        {{---------------------------------------js report show function-------------------------------------}}
        <script>
            function report()
            {
                var start=document.getElementById('start').value;
                var end=document.getElementById('end').value;
                var receptioncount='http://localhost:8000/report/receptioncount?start'+start+'&end='+end;
                var payment='http://localhost:8000/report/payment?start='+start+'&end='+end;
                var sta=document.getElementById('type').value;
                if (sta=='earning')
                {
                    fetch(payment)
                        .then(function(res) {
                            return res.json()
                        })
                        .then(function(data) {
                            window.alert('مجموعه دریافتی از تاریخ\n'+start+'\nتا تاریخ \n'+end+'\n برابر است با : '+data);

                        })
                }
                if (sta=='testsum')
                {
                    fetch(receptioncount)
                        .then(function(res) {
                            return res.json()
                        })
                        .then(function(data) {
                            window.alert('مجموعه آزمایشات انجام شده از تاریخ\n'+start+'\nتا تاریخ \n'+end+'\n برابر است با : '+data);

                        })
                }

            }
        </script>
        {{---------------------------------------js report show function-------------------------------------}}

        {{--////////////////////////////////////////////reporting////////////////////////////////////////////////////////--}}

    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootadmin.min.js"></script>

</body>
</html>