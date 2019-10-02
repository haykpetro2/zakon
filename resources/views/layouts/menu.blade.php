<div class="menu">
    <nav class="navbar navbar-expand-lg white_color nav_bg custom_nav">
        <a href=""></a>
        <button class="navbar-toggler for_notrans" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars white_color"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-center w-100">
                <li class="nav-item">
                    <a class="nav-link white_color" href="{{ route('home') }}" >@lang('home.home') <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropup position-static">
                    <a class="nav-link white_color dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('home.about_resource')
                    </a>
                    <div class="dropdown-menu theme_orange_bg" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('about') }}">@lang('home.about_company')</a>
                        <a class="dropdown-item" href="{{ route('lawyers') }}" >@lang('home.lawyers')</a>
                        <a class="dropdown-item" href="{{ route('labor-law') }}" >@lang('home.scope_law')</a>
                        <a class="dropdown-item" href="{{ route('review') }}" >@lang('home.reviews')</a>
                        <a class="dropdown-item" href="{{ route('vacancies') }}" >@lang('home.cooperation')</a>
                        <a class="dropdown-item" href="{{ route('contact') }}" >@lang('home.contacts')</a>
                    </div>
                </li>
                <li class="nav-item dropup position-static">
                    <a class="nav-link white_color dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('home.consultation')
                    </a>
                    <div class="dropdown-menu theme_orange_bg" aria-labelledby="navbarDropdown1">
                        <a class="dropdown-item" href="{{ route('labor-law') }}" >@lang('home.service_categories')</a>
                        <a class="dropdown-item" href="{{ route('labor-law') }}" >@lang('home.services_and_prices')</a>
                        <a class="dropdown-item" href="{{ route('reception') }}" >@lang('home.make_appointment')</a>
                        <a class="dropdown-item" href="{{ route('consulting') }}" >@lang('home.consultation')</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link white_color" href="{{ route('paperwork') }}" >@lang('home.paperwork')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link white_color" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal">@lang('home.support')</a>
                </li>
            </ul>
        </div>
    </nav>
</div>