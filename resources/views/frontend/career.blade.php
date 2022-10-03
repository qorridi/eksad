@extends('layouts.frontend')

@section('head_and_title')
    <meta name="description" content="EKSAD, Technology">
    <meta name="subject" content="EKSAD, Technology">
    <meta name="author" content="EKSAD">
    <title>EKSAD Technology</title>
@endsection

@section('content')


    <section  id="" class="bg-blue-eksad bg-about   py-5 martop">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5 text-center text-md-start">
                    <p class="txt-body1 font-rubik-bold text-white">Career</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="txt-body5 text-dark fw-bold">Open Positions</p>
                </div>
            </div>
            <div class="row py-5">
                <div class="col-md-5 pb-3">
                    <label for="search" class="txt-body4 text-dark">Job Search</label>
                    <div class="input-group">
                        <input type="text" id="search-keyword" class="form-control custom-search-bar" placeholder="Search Job" aria-label="Search Articles" aria-describedby="search-title" value="{{ $filterKeyword }}">
                        <span class="input-group-text custom-search-icon" id="search-articles"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <label for="search" class="txt-body4 text-dark">Department</label>
                    <div class="input-group mb-3">
                        <select id="department_option" class="form-select">
                            <option value="0">All</option>
                            @foreach($jobVacancyDepartments as $departments)
                                @if($departments->description == $selectedDepartment)
                                    <option value="{{ $departments->id }}" selected>{{$departments->description}}</option>
                                @else
                                    <option value="{{ $departments->id }}">{{$departments->description}}</option>
                                @endif
                            @endforeach
                        </select>
{{--                        <div class="dropdown">--}}
{{--                            <button class="btn btn-secondary dropdown-toggle px-5 px-md-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                @if($selectedDepartment != '')--}}
{{--                                    <span class="pe-md-5">{{ $selectedDepartment }}</span>--}}
{{--                                @else--}}
{{--                                    <span class="pe-md-5">All</span>--}}
{{--                                @endif--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                                @foreach($jobVacancyDepartments as $departments)--}}
{{--                                    <li><a class="dropdown-item" href="{{route('frontend.career') . '?job_department=' . $departments->id}}">{{$departments->description}}</a></li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <label for="search" class="txt-body4 text-dark">Level</label>
                    <div class="input-group mb-3">
                        <select id="level_option" class="form-select">
                            <option value="0" selected>All</option>
                            @foreach($jobLevels as $level)
                                @if($level->description == $selectedLevel)
                                    <option value="{{ $level->id }}" selected>{{$level->description}}</option>
                                @else
                                    <option value="{{ $level->id }}">{{$level->description}}</option>
                                @endif
                            @endforeach
                        </select>
{{--                        <div class="dropdown">--}}
{{--                            <button class="btn btn-secondary dropdown-toggle px-5 px-md-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                @if($selectedLevel != '')--}}
{{--                                    <span class="pe-md-5">{{ $selectedLevel }}</span>--}}
{{--                                @else--}}
{{--                                    <span class="pe-md-5">All</span>--}}
{{--                                @endif--}}
{{--                            </button>--}}
{{--                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                                @foreach($jobLevels as $level)--}}
{{--                                    <li><a class="dropdown-item" href="{{route('frontend.career') . '?job_level=' . $level->id}}">{{$level->description}}</a></li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">&nbsp;</label>
                    <div class="input-group mb-3">
                        <button class=" btn btn-outline-danger-c red-eksad px-4 py-2 br-10 mb-4" type="button" id="search_btn">Search</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <table>
                        <tr class="fw-bold text-dark txt-body2">
                            <th>Position</th>
                            <th>Department</th>
                            <th>Level</th>
                        </tr>
                        @foreach($jobVacancies as $jobVacancy)
                        <tr class="text-dark txt-body3">
                            <td><a href="{{route('frontend.career_detail', ['slug' => $jobVacancy->slug])}}" class="text-dark" >{{$jobVacancy->name}} <span class="red-eksad  ms-3 px-2 txt-body4 urgent" >Urgently Needed</span></a></td>
                            <td><a href="{{route('frontend.career_detail', ['slug' => $jobVacancy->slug])}}" class="text-dark" >{{$jobVacancy->job_vacancy_department->description}}</a></td>
                            <td><a href="{{route('frontend.career_detail', ['slug' => $jobVacancy->slug])}}" class="text-dark" >{{$jobVacancy->job_vacancy_level->description}} <span class="float-end fw-bold txt-body2 text-dark"> > </span></a></td>
                        </tr>
                        @endforeach
                        @if(count($jobVacancies) == 0)
                            <tr>
                                <td colspan="3">Career belum ditemukan...</td>
                            </tr>
                        @endif
                    </table>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/fontawesome-6.1.0/css/all.min.css') }}"/>
    <style>
        .urgent{
            border:1px solid #d42627;
            border-radius: 10px;
            font-style: italic;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        th{
            border-top: 1px solid #DDDDDD;
            border-bottom: 1px solid #DDDDDD;
        }
        tr:not(:last-child) {
            border: none;
        }
        .custom-search-bar{
            border-right: none;
        }

        .custom-search-icon{
            background-color: #fff;
            border-top: 1px solid var(--primary-l-color);
            border-bottom: 1px solid var(--primary-l-color);
            border-right: 1px solid var(--primary-l-color);
        }
        li{
            margin: 0;
        }
        .martop{
            margin-top: 9vh;
        }


        .btn-secondary{
            padding: 1em 2em;
            background-color: transparent;
            color: black;
            border: 1px solid gray;
            border-radius: 10px;
        }

        .custom-search-bar{
            border-right: none;
        }

        .custom-search-icon{
            background-color: #fff;
            border-top: 1px solid var(--primary-l-color);
            border-bottom: 1px solid var(--primary-l-color);
            border-right: 1px solid var(--primary-l-color);
        }

        .odd:not(.custom) .card:not(.no-hover):not(:hover){
            background-color: #184d47;
        }

    </style>
@endsection

@section('scripts')
    <script>
        $('#search-keyword').on('keypress', function (e) {
            if(e.which === 13){
                let keyword = $('#search-keyword').val();
                // if(!keyword){
                //     return false;
                // }

                $(this).prop('disabled', true);
                if(keyword.includes('%')){
                    alert("dont search with '%'!");
                }else{
                    let level = $('#level_option').val();
                    let department = $('#department_option').val();
                    let keyword = $('#search-keyword').val();
                    window.location.href = '{{ route('frontend.career') }}?keyword=' + keyword
                        + '&job_department=' + department + '&job_level=' + level;
                }
                $(this).prop('disabled', false);
            }
        });

        $('#search_btn').on('click', function (e) {
            let level = $('#level_option').val();
            let department = $('#department_option').val();
            let keyword = $('#search-keyword').val();
            window.location.href = '{{ route('frontend.career') }}?keyword=' + keyword
                + '&job_department=' + department + '&job_level=' + level;
        });
    </script>
@endsection
