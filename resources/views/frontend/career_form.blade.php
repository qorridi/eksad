@extends('layouts.frontend')

@section('head_and_title')
    <meta name="description" content="EKSAD, Technology">
    <meta name="subject" content="EKSAD, Technology">
    <meta name="author" content="EKSAD">
    <title>EKSAD Technology</title>
@endsection

@section('content')

    <!-- Banner -->
    <section  id="" class="bg-blue-eksad bg-about   py-5 martop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="txt-body3 text-white">Currently Applying for:</p>
                    <p class="txt-body5 font-rubik-bold text-white">{{$job->name}}</p>
                </div>
                <div class="col-md"></div>
                <div class="col-md-4 pt-3  text-white">
                    <div class="row">
                        <div class="col-4  border-banner-career">
                            <p>Level</p>
                            <p class="fw-bold txt-body3">{{$job->level}}</p>
                        </div>
                        <div class="col-4 border-banner-career">
                            <p>Division</p>
                            <p class="fw-bold txt-body3">{{$job->division}}</p>
                        </div>
                        <div class="col-4 border-banner-career">
                            <p>Location</p>
                            <p class="fw-bold txt-body3">Jakarta</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="vue-section" class="py-5">
        <div class="container">
            {{ Form::open(['route'=>['frontend.career_submit'],'method' => 'post','id' => 'carrer-form', 'enctype' => 'multipart/form-data']) }}

            <div class="row">
                <div class="col-sm-12">
                    @include('partials._success')
                    @include('partials._error')
                </div>
            </div>
            @if(count($errors))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row pb-3 text-dark">
                <div class="col-md-3 text-center text-md-start ">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active txt-tab" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="false">Personal Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link txt-tab" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link txt-tab" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">Experience</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link txt-tab" id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab" aria-controls="pills-4" aria-selected="false">Certifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link txt-tab" id="pills-5-tab" data-toggle="pill" href="#pills-5" role="tab" aria-controls="pills-5" aria-selected="false">CV & Portfolio</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 text-dark ">
                    <div class="tab-content txt-body3 text-dark py-3 px-3" id="pills-tabContent">
                        <div class="tab-pane fade show active " id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                            <p class="text-dark txt-body5 border-header-career">Personal Detail</p>
                            <input type="hidden" value="{{$job->id}}" name="job_vacancy_id">
                            <input type="hidden" value="{{$job->slug}}" name="job_vacancy_slug">
                            <div class="row pt-5 pb-3">
                                <div class="col-md-3 m-auto">
                                    <p><sup class="red-eksad ">*</sup>Full Name</p>
                                </div>
                                <div class="col-md">
                                    <input class="form-control" type="text" id="name" name="name" placeholder="ex. Sherlock Holmes" value="{{old('name')}}" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-3 m-auto">
                                    <p><sup class="red-eksad ">*</sup>Gender</p>
                                </div>
                                <div class="col-md">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="gender" value="male" checked>
                                                <label class="form-check-label" for="gender">
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                                                <label class="form-check-label" for="gender">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-3 m-auto">
                                    <p><sup class="red-eksad ">*</sup>Phone</p>
                                </div>
                                <div class="col-md">
{{--                                    <vue-autonumeric :options="autonumericFormat" name="phone" class="form-control" placeholder="0812 1234 5678"></vue-autonumeric>--}}
                                    <input class="form-control" type="number" id="phone" name="phone" placeholder="081212345678" value="{{old('phone')}}"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-3 m-auto">
                                    <p><sup class="red-eksad ">*</sup>Email Address</p>
                                </div>
                                <div class="col-md">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="ex. sherlockholmes@bakerstreet221b.com" value="{{old('email')}}" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-3 ">
                                    <p>Residence</p>
                                </div>
                                <div class="col-md">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><sup class="red-eksad ">*</sup>State / Province</p>
                                            <input class="form-control" type="text" id="province" name="province" placeholder="DKI Jakarta" value="{{old('province')}}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <p><sup class="red-eksad ">*</sup>Country</p>
                                            <input class="form-control" type="text" id="country" name="country" placeholder="Indonesia" value="{{old('country')}}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <p><sup class="red-eksad ">*</sup>City</p>
                                            <input class="form-control" type="text" id="city" name="city" placeholder="Kota Jakarta Barat" value="{{old('city')}}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <p><sup class="red-eksad ">*</sup>District</p>
                                            <input class="form-control" type="text" id="district" name="district" placeholder="Kec. Grogol Petamburan" value="{{old('district')}}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <p><sup class="red-eksad ">*</sup>Address</p>
                                            <textarea name="address" id="" cols="30" rows="3" placeholder="ex. Grogol Petamburan Jalan Letjend S. Parman">{{old('address')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-3 ">
                                    <p>Social Media</p>
                                </div>
                                <div class="col-md">
                                    <input class="form-control mb-3" type="text" id="sosmed-1" name="sosmed1" placeholder="ex. https://www.instagram.com/sherlockholmes"  value="{{old('sosmed1')}}">
                                    <input class="form-control mb-3" type="text" id="sosmed-2" name="sosmed2" placeholder="ex. https://www.facebook.com/sherlockholmes" value="{{old('sosmed2')}}" >
                                    <input class="form-control mb-3" type="text" id="sosmed-3" name="sosmed3" placeholder="ex. https://www.twitter.com/sherlockholmes" value="{{old('sosmed3')}}" >
                                    <input class="form-control mb-3" type="text" id="sosmed-4" name="sosmed4" placeholder="ex. https://www.linkedin.com/sherlockholmes" value="{{old('sosmed4')}}" >
                                    {{--                                    <a href="">--}}
                                    {{--                                        <p class="text-end txt-header-color">+ Add more link</p>--}}
                                    {{--                                    </a>--}}
                                </div>
                            </div>
                       </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                            <p class="text-dark txt-body5 border-header-career">Education <a href="" class="float-end border-add px-2 " data-toggle="modal" data-target="#education-modal"><span class="txt-body3">+ Add Education</span></a></p>
                            <div class="row txt-body3 text-dark pt-3" v-for="(item, index) in educationList">
                                <input type="hidden" name="eduInstitutional[]" v-model="item.eduInstitutional">
                                <input type="hidden" name="eduDegree[]" v-model="item.eduDegree">
                                <input type="hidden" name="eduFieldStudy[]" v-model="item.eduFieldStudy">
                                <input type="hidden" name="eduGrade[]" v-model="item.eduGrade">
                                <input type="hidden" name="eduLocation[]" v-model="item.eduLocation">
                                <input type="hidden" name="eduStartYear[]" v-model="item.eduStartYear">
                                <input type="hidden" name="eduEndYear[]" v-model="item.eduEndYear">
                                <input type="hidden" name="eduDesc[]" v-model="item.eduDesc">
                                <div class="col-md-3 text-end">
                                    <p><span>@{{item.eduStartYear}}</span>&nbsp;-&nbsp;<span>@{{item.eduEndYear}}</span></p>
                                </div>
                                <div class="col-md">
                                    <p>@{{item.eduFieldStudy}}</p>
                                    <p class="text-gray"><span>@{{ item.eduInstitutional }}</span>&nbsp;·&nbsp;<span>@{{ item.eduLocation }}</span></p>
                                </div>
                                <div class="col-md-1">
                                    <button v-on:click="removeItemEdu(item)"><i class="icon-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                            <p class="text-dark txt-body5 border-header-career">Experience <a href="" class="float-end border-add px-2" data-toggle="modal" data-target="#experience-modal"><span class="txt-body3">+ Add Experience</span></a></p>
                            <div class="row txt-body3 text-dark pt-md-3 pt-5" v-for="(item, index) in experienceList">
                                <input type="hidden" name="expTitle[]" v-model="item.expTitle">
                                <input type="hidden" name="expEmploymentType[]" v-model="item.expEmploymentType">
                                <input type="hidden" name="expCompany[]" v-model="item.expCompany">
                                <input type="hidden" name="expLocation[]" v-model="item.expLocation">
                                <input type="hidden" name="expStartMonth[]" v-model="item.expStartMonth">
                                <input type="hidden" name="expStartYear[]" v-model="item.expStartYear">
                                <input type="hidden" name="expEndMonth[]" v-model="item.expEndMonth">
                                <input type="hidden" name="expEndYear[]" v-model="item.expEndYear">
                                <input type="hidden" name="expDesc[]" v-model="item.expDesc">
                                <div class="col-md-3 text-end">
                                    <p><span>@{{ item.expStartMonth }} @{{ item.expStartYear }}</span>&nbsp;-&nbsp;<span>@{{ item.expEndMonth }} @{{ item.expEndYear }}</span></p>
                                </div>
                                <div class="col-md">
                                    <p>@{{ item.expTitle }} - @{{ item.expEmploymentType }}</p>
                                    <p class="text-gray"><span>@{{ item.expCompany }}</span>&nbsp;·&nbsp;<span>@{{ item.expLocation }}</span></p>
                                    <div class="border-header-career my-2"></div>
                                    <p>@{{ item.expDesc }}</p>
                                </div>
                                <div class="col-md-1">
                                    <button v-on:click="removeItemExp(item)"><i class="icon-trash"></i></button>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
                            <p class="text-dark txt-body5 border-header-career">Certifications</p>
                            <div class="row form-group pt-3">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="gambar">Upload Certificates:</label>
                                </div>
                                <div class="col-sm">
                                    <input type="file" class="form-control" id="featured-image" name="featured-image[]" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*"/>
                                    <label class="text-gray-dark">Format: .pdf, .doc, .docx, .jpg, .png, .tiff</label><br/>
                                    <label class="text-gray-dark">Maximum file size: 5 Mb</label>
                                </div>
                            </div>
                       </div>
                        <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-5-tab">
                            <p class="text-dark txt-body5 border-header-career">CV & Portfolio</p>
                            <div class="row pt-3">
                                <div class="col-md-3">
                                    <p><sup class="red-eksad ">*</sup>CV / Portfolio:</p>
                                </div>
                                <div class="col-md">
                                    <input type="file" name="cv-portfolio[]" id="cv-portfolio" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf,">
                                    <label class="text-gray-dark">Format: .pdf, .doc, .docx, </label><br/>
                                    <label class="text-gray-dark">Maximum file size: 5 Mb</label>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-3 ">
                                    <p>Online CV / portfolio:</p>
                                </div>
                                <div class="col-md">
                                    <input class="form-control mb-3" type="text" id="online-1" name="online-1" placeholder="ex. https://www.dribbble.com/sherlockholmes" value="{{old('online-1')}}" >
                                    <input class="form-control mb-3" type="text" id="online-2" name="online-2" placeholder="ex. https://github.com/sherlockholmes" value="{{old('online-2')}}" >
                               </div>
                            </div>
                            <div class="row pt-3 text-dark">
                                <div class="col-md-3">
                                    <p>Short Cover Letter</p>
                                </div>
                                <div class="col-md">
                                    <textarea name="short_desc" id="" cols="30" rows="4" placeholder="ex: Tell us why you’re interested in joining EKSAD, tell a short story about you, share to us your motivation in life, etc.">{{old('short_desc')}}</textarea>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-12 text-end">
                    <button id="btn_loading" type="button" class="btn btn-outline-success" style="display: none;">
                        <i class="spinner-border spinner-border-sm text-green" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </i>
                    </button>
                    <button type="submit" class=" btn btn-outline-danger-c red-eksad px-4 py-2 br-10 mb-4" id="send-appp">Send Application</button>
                </div>
            </div>

            {{ Form::close() }}
        </div>

        <!-- Modal Education -->
        <div class="modal fade" id="education-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title txt-body5" id="exampleModalLabel">Add Education</p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body txt-body4">
                        <div class="container">
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p><sup class="red-eksad ">*</sup>Institution</p>
                                    <input type="text" class="form-control" placeholder="ex: Universitas Indonesia" v-model="eduInstitutional" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p><sup class="red-eksad ">*</sup>Degree</p>
                                    <input type="text" class="form-control" placeholder="ex: Bachelor Degree" v-model="eduDegree" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-9 text-dark">
                                    <p>Field of Study</p>
                                    <input type="text" class="form-control" placeholder="ex: Organic Chemistry" v-model="eduFieldStudy">
                                </div>
                                <div class="col-3 text-dark">
                                    <p>Grade</p>
                                    <input type="text" class="form-control" placeholder="Grade" v-model="eduGrade">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p><sup class="red-eksad ">*</sup>Location</p>
                                    <input type="text" class="form-control" placeholder="ex: Jakarta Pusat, Jakarta" v-model="eduLocation" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-6">
                                    <p class="text-dark"><sup class="red-eksad ">*</sup>Start Year</p>
                                    <select class="form-select" aria-label="Default select example" v-model="eduStartYear" v-on:change="changeEndYearOption">
                                        <option v-for="item in eduStartYearOptions" :value="item">@{{item}}</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <p class="text-dark"><sup class="red-eksad ">*</sup>End Year (or expected)</p>
                                    <select class="form-select" aria-label="Default select example" v-model="eduEndYear">
                                        <option v-for="item in eduEndYearOptions" :value="item">@{{item}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-12">
                                    <p class="text-dark">Short Description</p>
                                    <textarea name="" id="" cols="30" rows="3" v-model="eduDesc"
                                              placeholder="School projects, extracurricular, achievements, organizational activities, student council, social activities, etc"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="w-100 btn-save py-2" v-on:click="addMoreItemEdu()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>

        <!-- Modal Experience-->
        <div class="modal fade" id="experience-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title txt-body5" id="exampleModalLabel">Add Experience</p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body txt-body4">
                        <div class="container">
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p><sup class="red-eksad ">*</sup>Title</p>
                                    <input type="text" class="form-control" placeholder="ex: Marketing Division Senior Staff" v-model="expTitle" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p>Employment Type</p>
                                    <select class="form-select" aria-label="Default select example" v-model="expEmploymentType">
                                        <option value="Full-time" selected>Full-time</option>
                                        <option value="Part-time">Part-time</option>
                                        <option value="Self-employed">Self-employed</option>
                                        <option value="Freelance">Freelance</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Internship">Internship</option>
                                        <option value="Apprenticeship">Apprenticeship</option>
                                        <option value="Seasonal">Seasonal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p>Company</p>
                                    <input type="text" class="form-control" placeholder="ex: PT Maju Bersama Indonesia Sentosa" v-model="expCompany" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-12 text-dark">
                                    <p><sup class="red-eksad ">*</sup>Location</p>
                                    <input type="text" class="form-control" placeholder="ex: Jakarta Pusat, Jakarta" v-model="expLocation" required>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-3">
                                    <p class="text-dark"><sup class="red-eksad ">*</sup>Start Month</p>
                                    <select class="form-select" aria-label="Default select example" v-model="expStartMonth">
                                        <option value="Jan" selected>Jan</option>
                                        <option value="Feb">Feb</option>
                                        <option value="Mar">Mar</option>
                                        <option value="Apr">Apr</option>
                                        <option value="May">May</option>
                                        <option value="Jun">Jun</option>
                                        <option value="Jul">Jul</option>
                                        <option value="Aug">Aug</option>
                                        <option value="Sept">Sept</option>
                                        <option value="Oct">Oct</option>
                                        <option value="Nov">Nov</option>
                                        <option value="Dec">Dec</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <p class="text-dark"><sup class="red-eksad ">*</sup>Start Year</p>
                                    <select class="form-select" aria-label="Default select example" v-model="expStartYear" v-on:change="changeEndExpYearOption">
                                        <option v-for="item in expStartYearOptions" :value="item">@{{item}}</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <p class="text-dark"><sup class="red-eksad ">*</sup>End Month</p>
                                    <select class="form-select" aria-label="Default select example" v-model="expEndMonth">
                                        <option value="Jan" selected>Jan</option>
                                        <option value="Feb">Feb</option>
                                        <option value="Mar">Mar</option>
                                        <option value="Apr">Apr</option>
                                        <option value="May">May</option>
                                        <option value="Jun">Jun</option>
                                        <option value="Jul">Jul</option>
                                        <option value="Aug">Aug</option>
                                        <option value="Sept">Sept</option>
                                        <option value="Oct">Oct</option>
                                        <option value="Nov">Nov</option>
                                        <option value="Dec">Dec</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <p  class="text-dark"><sup class="red-eksad ">*</sup>End Year</p>
                                    <select class="form-select" aria-label="Default select example" v-model="expEndYear">
                                        <option v-for="item in expEndYearOptions" :value="item">@{{item}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-12">
                                    <p class="text-dark">Short Description</p>
                                    <textarea name="" id="" cols="30" rows="3" v-model="expDesc"
                                              placeholder="School projects, extracurricular, achievements, organizational activities, student council, social activities, etc"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="w-100 btn-save py-2" v-on:click="addMoreItemExp()">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Scroll [to top] -->
    <div id="scroll-to-top" class="scroll-to-top">
        <a href="#header" class="smooth-anchor">
            <i class="icon-arrow-up"></i>
        </a>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('custom/bootstrap-fileinput/css/fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <style>
        .btn-save{
            border: 1px solid #d42627;
            background-color: #d42627;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            margin:auto;
        }
        ::placeholder{
            color: darkgrey !important;
        }
        .border-add{
            border: 1px solid rgba(24, 160, 251, 1);
            border-radius: 10px;
        }
        textarea{
            border-radius: 10px;
        }
        input,select{
            padding: 0.5rem;
        }
        sup{
            top:0;
        }
        .border-header-career{
            border-bottom: 1px solid #CCCCCC;
            width: 100%;
        }
        .border-banner-career{
            border-right: 1px solid rgba(255, 255, 255,.5);
            height: auto;
        }
        .txt-tab{
            font-size: 16px;
        }
        button{
            background-color: transparent;
            border-radius: 0;
            border: none;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color:#d42627;
            text-decoration: underline;
            font-weight: bold;
            background-color: transparent;
        }
        .nav{
            display: contents;
        }
        .martop{
            margin-top: 9vh;
        }



        @media(min-width: 576px){

        }
        @media(min-width: 1900px){

        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/bootstrap-fileinput/js/fileinput.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-autonumeric@1.2.6/dist/vue-autonumeric.min.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>

    <script>

        let vueComponent = new Vue({
            el: "#vue-section",
            data: {
                eduInstitutional: "",
                eduDegree: "",
                eduFieldStudy: "",
                eduGrade: "",
                eduLocation: "",
                eduStartYear: "2000",
                eduEndYear: "2000",
                eduDesc: "",
                educationList: [],
                eduStartYearOptions: [],
                eduEndYearOptions: [],
                expStartYearOptions: [],
                expEndYearOptions: [],

                expTitle: "",
                expEmploymentType: "Full-time",
                expCompany: "",
                expLocation: "",
                expStartMonth: "Jan",
                expStartYear: "2000",
                expEndMonth: "Jan",
                expEndYear: "2000",
                expDesc: "",
                experienceList: [],

                autonumericFormat: {
                    minimumValue: '0',
                    maximumValue: '9999999999999999',
                    digitGroupSeparator: '',
                    decimalCharacter: ',',
                    decimalPlaces: 0,
                    modifyValueOnWheel: false,
                    allowDecimalPadding: false,
                },
            },
            methods: {
                initiate(){
                    //edu
                    let year = 2000;
                    let thisYear = new Date().getFullYear();
                    for(let i=0; i<=40; i++){
                        if(year <= thisYear){
                            this.eduStartYearOptions.push(year);
                        }
                        year++;
                    }
                    year = 2000;
                    for(let i=1; i<=40; i++){
                        if(year <= thisYear + 10){
                            this.eduEndYearOptions.push(year);
                        }
                        year++;
                    }

                    //exp
                    year = 1980;
                    for(let i=0; i<=100; i++){
                        if(year <= thisYear){
                            this.expStartYearOptions.push(year);
                        }
                        year++;
                    }
                    year = 1980;
                    for(let i=1; i<=40; i++){
                        if(year <= thisYear + 10){
                            this.expEndYearOptions.push(year);
                        }
                        year++;
                    }
                },
                changeEndYearOption(){
                    let year = this.eduStartYear;
                    this.eduEndYearOptions = [];
                    let thisYear = new Date().getFullYear();
                    for(let i=1; i<=40; i++){
                        year++;
                        if(year <= thisYear + 10){
                            this.eduEndYearOptions.push(year);
                        }
                    }
                    this.eduEndYear = this.eduEndYearOptions[0];
                },
                changeEndExpYearOption(){
                    let year = this.expStartYear;
                    this.expEndYearOptions = [];
                    let thisYear = new Date().getFullYear();
                    for(let i=1; i<=40; i++){
                        year++;
                        if(year <= thisYear){
                            this.expEndYearOptions.push(year);
                        }
                    }
                    this.expEndYear = this.expEndYearOptions[0];
                },
                addMoreItemEdu() {
                    let itemIdx = this.educationList.length + 1;
                    let nItem = {
                        index: itemIdx,
                        no: itemIdx++,
                        eduInstitutional: this.eduInstitutional,
                        eduDegree: this.eduDegree,
                        eduFieldStudy: this.eduFieldStudy,
                        eduGrade: this.eduGrade,
                        eduLocation: this.eduLocation,
                        eduStartYear: this.eduStartYear,
                        eduEndYear: this.eduEndYear,
                        eduDesc: this.eduDesc,
                    };

                    this.educationList.push(nItem);
                    $('#education-modal').modal('toggle');
                },
                removeItemEdu(item) {
                    this.educationList = this.educationList.filter(function (x) { return x !== item; });
                },
                addMoreItemExp() {
                    let itemIdx = this.experienceList.length + 1;
                    let nItem = {
                        index: itemIdx,
                        no: itemIdx++,
                        expTitle: this.expTitle,
                        expEmploymentType: this.expEmploymentType,
                        expCompany: this.expCompany,
                        expLocation: this.expLocation,
                        expStartMonth: this.expStartMonth,
                        expStartYear: this.expStartYear,
                        expEndMonth: this.expEndMonth,
                        expEndYear: this.expEndYear,
                        expDesc: this.expDesc,
                    };

                    this.experienceList.push(nItem);
                    $('#experience-modal').modal('toggle');
                },
                removeItemExp(item) {
                    this.experienceList = this.experienceList.filter(function (x) { return x !== item; });
                },
            },
            mounted(){
                this.initiate();
            }
        });

        $('#carrer-form').submit(function(){
            $('#send-appp').hide();
            $('#btn_loading').show(200);
        })
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the link that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        $("#featured-image").fileinput({
            allowedFileExtensions: ["jpg", "jpeg", "png", "pdf", "doc", "docx"],
            overwriteInitial: false,
            maxFileSize: 5120,
            showUpload: false,
            multiple: true,
        });
        $("#cv-portfolio").fileinput({
            allowedFileExtensions: ["pdf", "doc", "docx"],
            overwriteInitial: false,
            maxFileSize: 5120,
            showUpload: false,
            multiple: true,
        });
        jQuery('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "dd M yyyy"
        });

    </script>

@endsection
