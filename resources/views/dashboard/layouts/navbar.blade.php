<style>
   /* .header-brand img {
        max-width: 50px;
        width: 50px;
    } */
     img {
        max-width: 50px;
        width: 50px;}
</style>

<div id="header_top" class="header_top dark">
    <div class="container">
        <div class="hleft">
            <a class="header-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/logosinusblanco.svg') }}" alt="">
            </a>
            <div class="dropdown">
                @if (Auth::check())

                    @role('director')

                    <a class="nav-link icon" id="dir" style="font-size:12px" title="Director"><i class="fa fa-user-circle"></i></a>

                    @role('IN')
                    <a  class="nav-link icon" id="in" style="font-size:12px" title="In"><i class="fa fa-user"></i></a>
                    @endrole

                    @role('OUT')
                    <a  class="nav-link icon" id="out" style="font-size:12px" title="Out"><i class="fa fa-user"></i></a>
                    @endrole

                    {{-- @role('doctor')
                    <a  class="nav-link icon" id="doc" style="font-size:12px"> Doctor </a>
                    @endrole --}}

                    @role('in-out')
                    <a  class="nav-link icon" id="io" style="font-size:12px" title="In-Out"><i class="fa fa-user"></i></a>
                    @endrole

                    @role('enfermeria')
                    <a  class="nav-link icon" id="en" style="font-size:10PX" title="Enfermeria"><i class="fa fa-medkit"></i></a>
                    @endrole

                    @role('farmaceuta')
                    {{-- <a  class="nav-link icon" id="far" style="font-size:10PX" title="Farmaceuta"><i class="fe fe-thermometer"></i></a> --}}
                    <a  class="nav-link icon" id="far" style="font-size:10PX" title="Farmaceuta"><i class="fa fa-eyedropper"></i></a>
                    @endrole


                    @endrole

                @endif
                {{-- <a href="page-search.html" class="nav-link icon"><i class="fa fa-search" data-toggle="tooltip" data-placement="right" title="Search..."></i></a>
                <a href="javascript:void(0)" class="nav-link icon create_page xs-hide"><i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Create New"></i></a>
                <a href="app-email.html" class="nav-link icon app_inbox"><i class="fa fa-envelope" data-toggle="tooltip" data-placement="right" title="Inbox"></i></a>
                <a href="app-filemanager.html" class="nav-link icon app_file xs-hide"><i class="fa fa-folder" data-toggle="tooltip" data-placement="right" title="File Manager"></i></a>
                <a href="app-social.html" class="nav-link icon xs-hide"><i class="fa fa-share-alt" data-toggle="tooltip" data-placement="right" title="Social Media"></i></a>
                <a href="javascript:void(0)" class="nav-link icon xs-hide"><i class="fa fa-bullhorn" data-toggle="tooltip" data-placement="right" title="Projects"></i></a>
                <a href="javascript:void(0)" class="nav-link icon xs-hide"><i class="fa fa-cloud-upload" data-toggle="tooltip" data-placement="right" title="Cloud Upload"></i></a> --}}
            </div>
        </div>
        <div class="hright">
            <div class="dropdown">
                {{-- <a href="javascript:void(0)" class="nav-link icon theme_btn"><i class="fa fa-paint-brush" data-toggle="tooltip" data-placement="right" title="Themes"></i></a> --}}
                <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fa fa-gear fa-spin" data-toggle="tooltip" data-placement="right" title="Settings"></i></a>
                <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar" src="..\assets\images\user.png" alt="" data-toggle="tooltip" data-placement="right" title="User Menu"></a>
                <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa  fa-align-left"></i></a>

            </div>
        </div>
    </div>
</div>

@include('dashboard.layouts.right-sidebar');
@include('dashboard.layouts.theme-menu');
@include('dashboard.layouts.user-menu');
