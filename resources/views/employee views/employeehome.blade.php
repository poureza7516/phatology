
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

                 <div class="card-body "> <a href="/register">
                  <button type="submit" class="btn btn-outline-info"  name="submit">Register</button>
                  </a>
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
                                                <button id="edit" type="submit" class="btn btn-outline-secondary"  onclick="deletetestshow()">Delete</button>
                                            </div>
                                                    <br>
                                            <button id="confirm" type="submit" class="btn btn-outline-primary"  onclick="savetests">Save</button>

                                        </div>
                              </div>

        {{--///////////////////////////////new test detail show/////////////////////////////////////////////////////////////////////////////--}}
                            <script>
                                function disptest() {
                                    var testname = document.getElementById("test-name").value;
                                    var para=document.createElement("input");
                                    para.type="checkbox";
                                    para.name="test_name";
                                    para.className="messageCheckbox"
                                    para.value=testname;
                                    document.getElementById("testshowname").appendChild(para);
                                    document.getElementById("testshowname").innerHTML += testname + '<br />';

                                    /////////////////////////////create test //////////////////////////////////////////
                                    // var test_name = document.getElementById('test-name').value;
                                    // var url = 'http://localhost:8000/createtest';
                                    // fetch(url, {
                                    //     method: 'POST',
                                    //     body: JSON.stringify({reception_id: reception_id , name: test_name}),
                                    //     headers: {
                                    //         'Content-Type': 'application/json',
                                    //         'Accept': 'application/json',
                                    //         "X-CSRF-Token": document.getElementById('csrf').value
                                    //     }
                                    // })
                                    //     .then(res => res.json())
                                    //     .then(data => alert(JSON.stringify(data)))
                                    //
                                    // //////////////////////////////////////////////////////////////////////


                                }
                            </script>


                        </div>

        {{--///////////////////////////////delete test/////////////////////////////////////////////////////////////////////////////--}}

                <script>
                    function deletetestshow() {
                        var checkedValue=null;
                        var inputElements=document.getElementsByClassName('messageCheckbox');



                        for (let i=0;inputElements[i];++i)
                        {

                            if (inputElements[i].checked)
                            {
                                alert(inputElements[i].value);

                               inputElements[i].value=null;
                               break;
                            }
                        }
                    }
                </script>


        {{--///////////////////////////////delete test/////////////////////////////////////////////////////////////////////////////--}}


        {{--/////////////////////////////js create new test function/////////////////////////////////////////////////////////////////////--}}


        {{--copy shod to qesmat namayesh est /--}}

                    {{--<script>--}}
                    {{--function createtest() {--}}
                    {{--//var record_id = document.getElementById('').innerHTML;--}}
                    {{--var test_name = document.getElementById('test-name').value;--}}
                    {{--var url = 'http://localhost:8000/createtest';--}}
                    {{--fetch(url, {--}}
                    {{--method: 'POST',--}}
                    {{--body: JSON.stringify({record_id: record_id , name: test_name}),--}}
                    {{--headers: {--}}
                    {{--'Content-Type': 'application/json',--}}
                    {{--'Accept': 'application/json',--}}
                    {{--"X-CSRF-Token": document.getElementById('csrf').value--}}
                    {{--}--}}
                    {{--})--}}
                    {{--.then(res => res.json())--}}
                    {{--.then(data => alert(JSON.stringify(data)))--}}
                    {{--}--}}
                    {{--</script>--}}

        {{--/////////////////////////////js create new test function/////////////////////////////////////////////////////////////////////--}}






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
                    <input type="text" class="text-formControlName=" id="reception-date" name="reception_date">
                </div>


                <div class="text" style=" margin-left: auto;" >
                    <label>تاریخ جواب دهی</label>
                    <input type="text" class="text-formControlName=" id="aswer-date" name="answer_date">
                </div>

                <div class="text" style=" margin-left: auto;" >
                    <label>دریافتی از بیمار</label>
                    <input type="text" class="text-formControlName=" id="payment" name="answer_date">
                </div>


                <div class="text" style=" margin-left: auto;" >
                    <label>وضعیت </label>
                    <select id="status">
                        <option value="In queue">در صف نمونه گیری</option>
                        <option value="Test progress">در حال انجام آزمایش</option>
                        <option value="Result ready">دریافت نتیجه</option>
                    </select>
                </div>
                <a href="/createreception"> <button type="submit" class="btn btn-outline-info" id="submit" name="submit" onclick="">Enter</button>
                </a>

            </div>
        </div>
        </div>





                {{--/////////////////////////////////js create new reception function ///////////////////////////////////////////////////--}}

                <script>
                    var reception_id;
                    function create() {
                        var user_id = document.getElementById('id').innerHTML;
                        var reception_date = document.getElementById('reception-date').innerHTML;
                        var answer_date = document.getElementById('answer-date').innerHTML;
                        var status = document.getElementById('status').innerHTML;
                        var payment = document.getElementById('payment').innerHTML;
                        var url = 'http://localhost:8000/createreception';
                        fetch(url, {
                            method: 'POST',
                            body: JSON.stringify({user_id: user_id ,reception_date:reception_date ,
                                answer_date:answer_date ,status:status ,payment:payment}),
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                "X-CSRF-Token": document.getElementById('csrf').value
                            }
                        })
                            .then(res => res.json())
                            .then(data => {
                                reception_id = data['id'];
                            })
                    }
                </script>

                {{--/////////////////////////////////js create new reception function ///////////////////////////////////////////////////--}}

        {{--////////////////////////////////////////////////////reciption informationm////////////////////////////////////////////////////////--}}




        {{-----//////////////////////////////////////redirect to phatoloyst page///////////////////////////////////////////////////////--}}

        <div class="modal-sm">
            <div class="position-absolute" style="left: 73%;top: 10.5%;">
                <div class="card card-body">
                    <div class="card card-header">
                        <label>نتایج </label>
                    </div>
                    <hr>
                    <a href="/phatologysts">
                        <button class="btn-outline-primary">ورود به صفحه نتایج</button>
                    </a>

                </div>
            </div>
        </div>


        {{-----//////////////////////////////////////redirect to phatoloyst page///////////////////////////////////////////////////////--}}

    </div>
@endsection