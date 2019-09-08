@extends('layouts.app')

@section('content')
    <div style="font-family: 'B Nazanin'; font-size: medium;">




        {{--///////////////////////////////////////search employeee////////////////////////////////////////////////--}}
        <div class="position-absolute" style="left: 2%;top: 10.5%;">
                <div class=" modal-sm">
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
                            {{--<button id="edit" type="submit" class="btn btn-outline-secondary"  onclick="//edit()">Delete</button>--}}
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
                        if (data.type =='employee') {
                            ////////////////////////////////////////////////
                            document.getElementById('id').innerHTML = data.id;
                            document.getElementById('name').innerHTML = data.name;
                            document.getElementById('phone').innerHTML = data.phone;
                            document.getElementById('gender').innerHTML = data.gender;
                            document.getElementById('national-id').innerHTML = data.national_id;
                            ////////////////////////////////////////////////
                        }
                        else {
                            alert('کارمند مورد نظر یافت نشد');
                        }

                    }, err=>alert('ابتدا ثبت نام کنید'))


            }
        </script>

        {{--/////////////////////////////////js search function ///////////////////////////////////////////////////--}}


        {{--///////////////////////////////////////search employeee////////////////////////////////////////////////--}}



        {{--///////////////////////////////////// create new employee ///////////////////////////////////////////////////--}}

        <div class="modal-sm ">

            <div class="position-absolute " style="left:25%; top:10.5%;">
                <div class="card card-body">
                    <div class="card-header">ثبت  کارمند جدید</div>
                    <hr>

                    <a href="/register">
                        <button type="submit" class="btn btn-outline-info"  name="submit">Register</button>
                    </a>

                </div>
            </div>
        </div>


        {{--///////////////////////////////////// create new employee ///////////////////////////////////////////////////--}}



        {{--///////////////////////////////////////// reporting section///////////////////////////////////////////--}}
            <div class="position-absolute" style="left: 50%;top: 10.5%;">
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

        {{--///////////////////////////////////////// reporting section///////////////////////////////////////////--}}




    </div>


@endsection