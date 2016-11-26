@extends('layouts.main')
@section('title', "$metaTitle")
@section('page-css')
    <link href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="container userprofile">
{{--        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="toplinks">
                <p>You are here :</p>
                <ul>
                    <li class="first"><a href="{{route('/')}}">Home</a></li>
                    <li ><a href="{{route('user.profile.view')}}">Profile</a></li>
                    <li >Edit Profile</li>
                </ul>
            </div>
        </div>--}}
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1" id="logout">
                <div class="page-header">
                    <h3 class="reviews">Update Your Profile</h3>
                </div>
            </div>
        </div>
        @include('partials.error')
        <form action="{{route('user.profile.edit')}}" method="POST" id="signupForm">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="" for="exampleInputEmail3">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" tabindex="1" value="{{$user->first_name}}">
                                @if($errors->first('first_name'))<p class="error">{{$errors->first('first_name')}}</p>@endif
                            </div>
                            <div class="form-group">
                                <label class="" for="email">Email</label>
                                <input type="email" class="form-control" id="email"  name="email" placeholder="Email" tabindex="3" value="{{$user->email}}">
                                @if($errors->first('email'))<p class="error">{{$errors->first('email')}}</p>@endif
                            </div>
                            <div class="form-group">
                                <label class="" for="state">State</label>
                                <select class="form-control" id="state" name="state" tabindex="5">
                                    <option value="">Select State</option>
                                    @if($states)
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" @if($state->id == $user->state_id) selected='selected' @endif>{{ucfirst($state->name)}}</option>
                                            @@endforeach
                                    @endif
                                </select>
                                @if($errors->first('state'))<p class="error">{{$errors->first('state')}}</p>@endif
                            </div>
                            @if($user->role->role_id == 3)
                            <div class="form-group">
                                <label>Birth Date:</label>
                                <input tabindex="7" name="birth_date" data-autoclose="true" id="birth_date" class="form-control" required="required" value="{{$user->birth_date}}" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" />
                            </div>
                            @if($errors->first('birth_date'))<p class="error">{{$errors->first('birth_date')}}</p>@endif
                            @endif
                            <div class="form-group">
                                <label>Phone Number:</label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number" value="{{$user->phone_no}}" tabindex="9"/>
                            </div>
                            @if($errors->first('phone_no'))<p class="error">{{$errors->first('phone_no')}}</p>@endif
                            @if($user->role->role_id == 2)
                            <div class="form-group">
                                <label>Profile Avatar:</label>
                                <input type="file" name="image" id="image" />
                                <input type="hidden" name="fileName" id="fileName" value="{{$user->profile_image}}" />
                                <input type="hidden" name="mediatype" id="mediatype" value="image" />
                            </div>
                            <div id="uploadwrapper">
                                @if($user->profile_image != NULL)
                                    <img src="{{asset('uploads/user')}}/{{$user->profile_image}}" />
                                    <a class="removeuploadmedia" href="javascript:void(0);" title="Remove Profile Picture"><i class="glyphicon glyphicon-remove-sign"></i></a>
                                @endif
                            </div>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="" for="exampleInputPassword3">Last Name</label>
                                <input type="text" class="form-control" id="last_name"  name="last_name" placeholder="Last Name"  tabindex="2" value="{{$user->last_name}}">
                                @if($errors->first('last_name'))<p class="error">{{$errors->first('last_name')}}</p>@endif
                            </div>
                            <div class="form-group">
                                <label class="" for="gender">Select Gender</label>
                                <select class="form-control" id="gender" name="gender" tabindex="4">
                                    <option value="">Select Gender</option>
                                    <option value="male"  @if($user->gender == 'male') selected='selected' @endif>Male</option>
                                    <option value="female" @if($user->gender == 'female') selected='selected' @endif>Female</option>
                                </select>
                                @if($errors->first('gender'))<p class="error">{{$errors->first('gender')}}</p>@endif
                            </div>
                            <div class="form-group">
                                <label class="" for="city">City</label>
                                <select class="form-control" id="city" name="city" tabindex="6">
                                    <option value="">Select City</option>
                                    @if($cities)
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if($city->id == $user->city_id) selected='selected' @endif>{{ucfirst($city->name)}}</option>
                                            @@endforeach
                                    @endif
                                </select>
                                @if($errors->first('city'))<p class="error">{{$errors->first('city')}}</p>@endif
                            </div>
                            <div class="form-group">
                                <label>Mobile Number:</label>
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile Number" value="{{$user->mobile_no}}" tabindex="8"/>
                            </div>
                            @if($user->role->role_id == 3)
                            <div class="form-group">
                                <label>Profile Avatar:</label>
                                <input type="file" name="image" id="image" />
                                <input type="hidden" name="fileName" id="fileName" value="{{$user->profile_image}}" />
                                <input type="hidden" name="mediatype" id="mediatype" value="image" />
                            </div>
                            <div id="uploadwrapper">
                                @if($user->profile_image != NULL)
                                    <img src="{{asset('uploads/user')}}/{{$user->profile_image}}" />
                                    <a class="removeuploadmedia" href="javascript:void(0);" title="Remove Profile Picture"><i class="glyphicon glyphicon-remove-sign"></i></a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>

        @if($user->role->role_id == 3)
        <div class="row">
            <div class="col-sm-12 col-sm-offset-1" id="logout">
                <div class="page-header">
                    <h3 class="reviews">Academic Information</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="" for="state">College State</label>
                        <select class="form-control" id="college_state" name="college_state" tabindex="9">
                            <option value="">Select State</option>
                            @if($states)
                                @foreach($states as $state)
                                    <option value="{{$state->id}}" @if($state->id == $user->student->college_state_id) selected='selected' @endif>{{ucfirst($state->name)}}</option>
                                    @@endforeach
                            @endif
                        </select>
                        @if($errors->first('state'))<p class="error">{{$errors->first('state')}}</p>@endif
                    </div>
                    <div class="form-group">
                        <label>University Name:</label>
                        <input type="text" name="university_name" id="university_name" class="form-control" required="required" placeholder="University Name" value="{{$user->student->university_name}}" tabindex="11"/>
                    </div>
                    <div class="form-group">
                        <label>Degree Name:</label>
                        <select class="form-control" required="required" name="education_degree_id" id="education_degree_id" tabindex="13">
                            <option value="">Select Degree</option>
                            @foreach($degrees as $degree)
                                @if(isset($user->student) && $user->student->education_degree_id == $degree->id)
                                    <?php $selected = 'selected="selected"'; ?>
                                @else
                                    <?php $selected = ''; ?>
                                @endif
                                <option value="{{$degree->id}}" {{$selected}}>{{$degree->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Academic Month:</label>
                        <select class="form-control" required="required" name="month" id="month" tabindex="15">
                            <option value="">Select Month</option>
                            @foreach($months as $month)
                                <option value="{{$month}}" @if(isset($user->student) && $user->student->passing_month == $month) selected = 'selected' @endif>{{$month}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="" for="city">College City</label>
                        <select class="form-control" id="college_city" name="college_city" tabindex="10">
                            <option value="">Select City</option>
                            @if($cities)
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" @if(isset($user->student) && $city->id == $user->student->college_city_id) selected='selected' @endif>{{ucfirst($city->name)}}</option>
                                    @@endforeach
                            @endif
                        </select>
                        @if($errors->first('city'))<p class="error">{{$errors->first('city')}}</p>@endif
                    </div>
                    <div class="form-group">
                        <label>College Name:</label>
                        <input type="text" class="form-control" id="college_name"  name="college_name" placeholder="College Name" value="{{$user->student->college_name}}" tabindex="12">
                    </div>
                    @if($errors->first('college_name'))<p class="error">{{$errors->first('college_name')}}</p>@endif
                    <div class="form-group">
                        <label>Course Type/Branch Name:</label>
                        <select class="form-control" required="required" name="education_course_type_id" id="education_course_type_id" tabindex="14">
                            <option value="">Select Branch</option>
                            @foreach($courseTypes as $courseType)
                                @if(isset($user->student) && $user->student->education_course_type_id == $courseType->id)
                                    <?php $selected = 'selected="selected"'; ?>
                                @else
                                    <?php $selected = ''; ?>
                                @endif
                                <option value="{{$courseType->id}}" {{$selected}}>{{$courseType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Academic Year:</label>
                        <?php $year = date('Y');?>
                        <select class="form-control" required="required" name="year" id="year" tabindex="16">
                            <option value="">Select Passing Year</option>
                            @for($index = $year; $index >= 1940; $index--)
                                <option value="{{$index}}" @if(isset($user->student) && $index == $user->student->passing_year) selected='selected' @endif>{{$index}}</option>
                            @endfor
                        </select>
                    </div>
                    @if($errors->first('year'))<p class="error">{{$errors->first('year')}}</p>@endif
                </div>
            </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2 action-row">
                <div class="form-group">
                    <div class="col-sm-5">
                        <input type="submit" class="btn btn-block btn-primary text-uppercase" value="Save" tabindex="17">
                    </div>
                    <div class="col-sm-5">
                        <p class="change_link">
                            <a href="{{route('user.profile.view')}}" class="btn btn-block btn-primary text-uppercase" tabindex="18"> Cancel </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@section('page-script')
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script type="application/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#user_image_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#user_image").change(function(){
            readURL(this);
        });
    </script>
    <script>
        $(function(){
            $("#first_name").focus();
            $('#birth_date').datepicker({
                endDate: '-1Y'
            });
            var route = '{{route("get-cities")}}';
            $(document).on("change","#state",function(){
                $.ajax({
                    url:route,
                    type:"POST",
                    data:{'stateId':$(this).val()},
                    dataType:"JSON",
                    beforeSend:function(){

                    },
                    success:function(msg){
                        res = msg;
                    },
                    complete:function() {
                        if(res.valid && res.response != null) {
                            $("#city").html(res.response);
                        } else {
                            $("#city").html('<option value="">Select City</option>');
                        }

                        $("#city").focus();
                    }
                });
            });
            $(document).on("change","#college_state",function(){
                $.ajax({
                    url:route,
                    type:"POST",
                    data:{'stateId':$(this).val()},
                    dataType:"JSON",
                    beforeSend:function(){

                    },
                    success:function(msg){
                        res = msg;
                    },
                    complete:function() {
                        if(res.valid && res.response != null) {
                            $("#college_city").html(res.response);
                        } else {
                            $("#college_city").html('<option value="">Select City</option>');
                        }

                        $("#college_city").focus();
                    }
                });
            });

            var collegeRoute = '{{route("get-colleges")}}';
            $(document).on("change","#college_city",function(){
                $.ajax({
                    url:collegeRoute,
                    type:"POST",
                    data:{'stateId':$("#college_state").val(),'cityId':$("#college_city").val()},
                    dataType:"JSON",
                    beforeSend:function(){

                    },
                    success:function(msg){
                        res = msg;
                    },
                    complete:function() {
                        if(res.valid && res.response != null) {
                            $("#college_id").html(res.response);
                        } else {
                            $("#college_id").html('<option value="">Select College</option>');
                        }

                        $("#College_id").focus();
                    }
                });
            });

        });
    </script>
@endsection
