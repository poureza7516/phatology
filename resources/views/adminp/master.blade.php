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

            <li><a href="#" onclick="hs('user');"> جستجو کاربر  </a></li>
            <li><a href="/register"> ثبت نام کاربر  </a></li>
            <li><a href="#" onclick="hs('reception');"> پذیرش  </a></li>
            <li><a href="#" onclick="hs('test');">    موارد آزمایش  </a></li>
            <li><a href="/phatologysts"> نتایج</a>
        </ul>
    </div>

    <div class="content p-4">



        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}
        <script>
            function hs(id)
            {
                document.getElementById('user').style.display="none";
                document.getElementById('reception').style.display="none";
                document.getElementById('test').style.display="none";
             var x=document.getElementById(id);
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
        {{--////////////////////////////////hiding and showing //////////////////////////////////////////////////////////--}}


        {{--////////////////////////////////////////////////////////////user finding ///////////////////////////////////////////--}}
        <div class="content p-4">
            <div class=" position-relative" style="top: 15%;left: 22%; height: auto;width: 50%;" id="user">
                <div class=" card card-body">
                    <input id="csrf" type="hidden" name="__token" value={{csrf_token()}} >
                    {{csrf_field()}}
                    <div class="card-header">جستجو بیمار</div>
                    <label>کد ملی :</label>
                    <input id="national_id" type="text" name="national_id" class="form-control" required />
                    <hr>
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
                    </div>

                </div>
            </div>

            {{--/////////////////////////////////js search function ///////////////////////////////////////////////////--}}

            <script>
                function ss() {
                    var national = document.getElementById('national_id').value;
                    var url = 'http://localhost:8000/employeehome/search?national_id=' + national;
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
                        }, err=>alert('ابتدا ثبت نام کنید'))
                }
            </script>

            {{--/////////////////////////////////js search function ///////////////////////////////////////////////////--}}

        </div>
        {{--////////////////////////////////////////////////////////////user finding ///////////////////////////////////////////--}}

        {{--///////////////////////////////////////////////////reception////////////////////////////////////////////////////////////--}}
        <div class="content p-4" >
            <div class=" position-relative" style="top: 3%;left: 22%; height: auto;width: 50%;display: none;" id="reception">
                <div class="card card-body">
                    <div class="card card-header">
                        <label>اطلاعات پذیرش </label>
                    </div>
                    <hr>

                    <div class="text" style=" margin-left: auto;" >
                        <label>تاریخ پذیرش</label>
                        <input type="date" class="text-formControlName=" id="reception-date" name="reception-date">
                    </div>

                    <div class="text" style=" margin-left: auto;" >
                        <label>تاریخ جواب دهی</label>
                        <input type="date" class="text-formControlName=" id="answer-date" name="answer-date">
                    </div>

                    <div class="text" style=" margin-left: auto;" >
                        <label>دریافتی از بیمار</label>
                        <input type="text" class="text-formControlName=" id="payment" name="payment" placeholder="هزینه آزمایش">
                    </div>


                    <div class="text" style=" margin-left: auto;" >
                        <label>وضعیت </label>
                        <select id="status">
                            <option value="In queue">در صف نمونه گیری</option>
                            <option value="ready">دریافت نتیجه</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-info" id="submit" name="submit" onclick="create();recid();">Enter</button>


                </div>
            </div>
        </div>

        {{--/////////////////////////////////js create new reception function ///////////////////////////////////////////////////--}}

        <script>
            var reception_id;
            function create() {
                var user_id = document.getElementById('id').innerHTML;
                var reception_date = document.getElementById('reception-date').value;
                var answer_date = document.getElementById('answer-date').value;
                var status = document.getElementById('status').value;
                var payment = document.getElementById('payment').value;
                var url = 'http://localhost:8000/createreception';
                fetch(url, {
                    method: 'POST',
                    body: JSON.stringify({
                        user_id: user_id, reception_date: reception_date,
                        answer_date: answer_date, status: status, payment: payment
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        "X-CSRF-Token": document.getElementById('csrf').value
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        reception_id = data['id'];
                        alert(reception_id);
                    })
            }
        </script>
        {{--///////////////////////////////////////////////////reception////////////////////////////////////////////////////////////--}}

        {{--/////////////////////////////////////////////////test///////////////////////////////////////////////////////////////////////////--}}
        <div  class=" position-relative" style="top: 1%;left: 22%; height: auto;width: 50%;display: none;" id="test">
            <div class="modal-lg">
                <div class="card card-body">

                    <div class="card card-header">ثبت آزمایشات</div>

                    <div class="input-group-text">
                        <label >نام آزمایش :</label>
                        <input type="text" class="input-group" name="test_name" id="test-name">
                    </div>
                    <br>
                    <button type="submit" onclick="disptest();" class="btn btn-outline-info" id="addtest" name="addtest">Add New Test</button>

                    <hr>
                    <div  class="card card-text">

                        <table class="table table-info table-striped">
                            <tr>
                                <th>نام آزمایش</th>
                            </tr>
                            <tr id="">
                                <td id="testshowname"></td>
                            </tr>
                        </table>
                    </div>


                </div>
            </div>
            {{--//////////////////////////////////js add test function/////////////////////////////////////////////////////--}}
            <script>
                function disptest(){
                    win=window.confirm('از ذخیره آزمایش مطمئن هستید؟');
                    if(win)
                    {
                        var testname = document.getElementById("test-name").value;
                        var para=document.createElement("tablerow");
                        para.type='';
                        para.name="test_name";
                        para.className="tablerow"
                        para.value=testname;
                        document.getElementById("testshowname").appendChild(para);
                        document.getElementById("testshowname").innerHTML += testname + '<br />';
                        /////////////////////////////create test //////////////////////////////////////////
                        var test_name = document.getElementById('test-name').value;
                        var url = 'http://localhost:8000/createtest';
                        var test_id;
                        fetch(url, {
                            method: 'POST',
                            body: JSON.stringify({reception_id: reception_id , name: test_name}),
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                "X-CSRF-Token": document.getElementById('csrf').value
                            }
                        })
                            .then(res => res.json())
                            .then(data => {
                                test_id = data['id'];
                                alert(test_id);
                            })
                        //
                        // //////////////////////////////////////////////////////////////////////
                    }
                }
            </script>
            {{--//////////////////////////////////js add test function/////////////////////////////////////////////////////--}}


        </div>
        {{--/////////////////////////////////////////////////test///////////////////////////////////////////////////////////////////////////--}}
    </div>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootadmin.min.js"></script>

</body>
</html>