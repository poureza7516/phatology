@extends('layouts.app')

@section('content')



        <div style="font-family: 'B Nazanin'; font-size: medium;">


            <div class="position-absolute" style="left: 5%;top: 10.5%;">
                <div class="card card-header">
                    <label>دریافت نتیجه آزمایش</label>
                </div>

                <div class="card card-body">
                    <label>شماره پذیرش را وارد کنید</label>
                    <input type="text" id="reception-id" name="reception_id" >
                    <hr>
                    <button class="btn-outline-success" onclick="showrecords();">دریافت نتیجه </button>
                    <button id="edit" type="submit" class="btn btn-outline-secondary"  onclick="//print()">Print</button>

                </div>
            </div>


            {{--////////////////////////////show result//////////////////////////////////////////////////--}}
                <div class="position-absolute" style="left: 60%;top:10.5%;">

                        <div  class="table table-responsive">

                            <table class="table table-info table-striped">
                                <tr>
                                    <th>نام آزمایش</th>
                                    <th >نتیجه</th>
                                    <th >توضیحات</th>
                                </tr>
                                <tr >
                                    <td id="name"></td>
                                    <td id="result"></td>
                                    <td id="description"></td>
                                </tr>
                            </table>

                        </div>
                  </div>

                {{--////////////////////////////////////show result//////////////////////////////////////////////////--}}




            {{--////////////////////////////js show tests function///////////////////////////////////////--}}
            <script>
                function showtest() {

                        var receptionid = document.getElementById('reception-id').value;
                        // const url = 'http://localhost:8000/employeehome/search?national_id=' + national;
                        console.log(url);
                        fetch(url)
                            .then(function(res) {
                                return res.json()
                            })
                            .then(function(data) {
                                ////////////////////////////////////////////////
                                document.getElementById('name').innerHTML = data.name;
                                document.getElementById('result').innerHTML = data.result;
                                document.getElementById('description').innerHTML = data.description;

                                ////////////////////////////////////////////////
                            }, err=>alert('ابتدا ثبت نام کنید'))

                }
            </script>

            {{--////////////////////////////js show tests function///////////////////////////////////////--}}


            {{----------------------show records ------------------------------------------------------------}}
            <div class="position-absolute" style="left: 30%;top:10.5%;">

                <div  class="table table-responsive">

                    <table class="table table-info table-striped">
                        <tr>
                            <th>تاریخ انجام آزمایش</th>
                            <th >شماره پذیرش</th>
                        </tr>
                        <tr >
                            <td id="reception_date"></td>
                            <td id="reception_id"></td>
                        </tr>
                    </table>

                </div>
            </div>


            {{----------------------show records ------------------------------------------------------------}}



        </div>

@endsection