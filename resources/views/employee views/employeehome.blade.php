
@extends('layouts.app')

@section('content')


    <div style="font-family: 'B Nazanin'; font-size: medium;">


        <div class="col-md-5">
            <div class="modal-sm">
                <div class=" card card-body">
                    <input id="csrf" type="hidden" name="__token" value={{csrf_token()}} >
                    {{csrf_field()}}
                    <div class="card-header">جستجو بیمار</div>
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
                    </div>

                    <hr>
                    <div class="card-header">ثبت  بیمار جدید</div>

                    <a href="/register">
                    <div class="card card-body ">
                            <button type="submit" class="btn btn-outline-info"  name="submit">Register</button>
                    </div>
                    </a>

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

        <div class="position-absolute" style="left: 50%; top: 10.5%;">
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


        </div>








        {{--////////////////////////////////////////////////////reciption informationm////////////////////////////////////////////////////////--}}
        <div class="modal-sm">
            <div class="position-absolute" style="left: 26%;top: 10.5%;">
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
                            <option value="Test progress">در حال انجام آزمایش</option>
                            <option value="Result ready">دریافت نتیجه</option>
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
            // function recid() {
            //
            //     var url = 'http://localhost:8000/curentreception;'
            //     console.log(url);
            //     fetch(url)
            //         .then(function(res) {
            //             return res.json()
            //         })
            //         .then(function(data) {
            //             ////////////////////////////////////////////////
            //             reception_id = data.id;
            //             ////////////////////////////////////////////////
            //         },alert(reception_id));
            // }
        </script>

        {{--///////////////////////////////new test detail show/////////////////////////////////////////////////////////////////////////////--}}
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

        {{--/////////////////////////////////js create new reception function ///////////////////////////////////////////////////--}}

        {{--////////////////////////////////////////////////////reciption informationm////////////////////////////////////////////////////////--}}




        {{-----//////////////////////////////////////redirect to phatoloyst page///////////////////////////////////////////////////////--}}

        <div class="modal-sm">
            <div class="position-absolute" style="left: 80%;top: 10.5%;">
                <div class="card card-body">
                    <div class="card card-header">
                        <label>اعمال </label>
                    </div>
                    <hr>
                    <a href="/phatologysts">
                        <div class="card card-body">
                            <button class="btn btn-outline-info"> بخش نتایج</button>
                        </div>

                    </a>

                    <a href="/employeehome">
                        <div class="card card-body">
                            <button class="btn btn-outline-info">پذیرش بیمار جدید</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        {{-----//////////////////////////////////////redirect to phatoloyst page///////////////////////////////////////////////////////--}}

    </div>
@endsection