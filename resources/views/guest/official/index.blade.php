@extends('layouts.guest.app')

@section('title', 'Barangay San Gavino | Officials')

@section('content')
    <!-- Page content -->
    <div class="container-fluid mt-3"><br>
        <h1 class="text-success text-center">List of Officials <i class="fas fa-users ms-1"></i></h1><br><br>
        <div class="row g-0 team-items">
            @foreach ($officials as $official)
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative">
                        <div class="position-relative">
                            <img class="img-fluid d-block mx-auto rounded-circle"
                                src="{{ handleNullAvatar($official->avatar_profile) }}" width="150" alt="">

                        </div>
                        <div class="bg-light text-center p-4">
                            <h3 class="mt-2">{{ $official->name }}</h3>
                            <span class="text-success">{{ $official->position->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br><br><br>
        <h1 class="text-success text-center">Barangay Officials Chart</h1> <br><br>
        <div class="row justify-content-center">
            <div class="col-md-12 bg-dark"><br>
                <div class="card bg-dark">
                    <div class="card-body">
                        <div id="chart_officials" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
@section('script')
    <script src="{{ asset('assets/js/utils/orgchart.js') }}"></script>
    <script>
        const officials = @json($officials);
        const filtered_officials = [];
        const logo = "/img/logo/logo.png";
        const img = "/img/noimg.svg";

        officials.forEach(official => {
            filtered_officials.push({
                id: official.position.id,
                pid: official.position.pid,
                name: `${official.name}`,
                title: `${official.position.name}`,
                img
            })
        })

        console.log(filtered_officials)

        const officials_chart = new OrgChart(document.getElementById("chart_officials"), {
            // template: "olivia",
            enableSearch: false,
            // mouseScrool: OrgChart.action.none,
            mode: "dark",
            layout: OrgChart.normal,
            orientation: OrgChart.orientation.left,
            scaleInitial: OrgChart.match.boundary, //0.6 || OrgChart.match.boundary ,
            nodeMouseClick: OrgChart.action.none, //disable
            editForm: {
                readOnly: true,
                buttons: {
                    pdf: null
                }
            },
            nodeBinding: {
                field_0: "name",
                field_1: "title",
                img_0: "img"
            },
            nodes: [{
                    id: 0,
                    name: "Barangay San Gavino",
                    img: logo
                },
                ...filtered_officials
            ],
        });
        $('#officials_nav').addClass('active')
    </script>
@endsection
