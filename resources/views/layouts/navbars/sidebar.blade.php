<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <div class="nav-item">
                    <a href="{{ route('executor.index') }}" class="nav-link" id="pelaksana">
                        <i class="ni ni-single-02 text-info"></i>{{__('Pelaksana')}}
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('patient.index') }}" class="nav-link" id="pasien">
                        <i class="ni ni-support-16" style="color: #e2de00;"></i>{{__('Pasien')}}
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('patient_test.index') }}" class="nav-link" id="pasien_test">
                        <i class="ni ni-ambulance" style="color: #e200b1;"></i>{{__('Pemeriksaan Pasien')}}
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('item.index') }}" class="nav-link" id="items">
                        <i class="ni ni-atom text-warning"></i>{{__('Items')}}
                    </a>
                </div>
                <li class="nav-item">
                    <a class="nav-link" id="hasil-menu" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fas fa-vials" style="color: #f4645f;"></i>
                        <span class="nav-link-text">{{ __('Hasil Lab') }}</span>
                    </a>

                    <div class="collapse" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" id="tipe-hasil-menu" href="{{ route('hasil_lab_tipe.index') }}">
                                    {{ __('Hasil Lab Tipe') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rincian-hasil-menu" href="{{ route('hasil_lab_tiper.index') }}">
                                    {{ __('Hasil Lab Rincian') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pemeriksaan-menu" href="{{ route('hasil_lab.index') }}">
                                    {{ __('Pemeriksaan') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <div class="nav-item">
                    <a href="{{ route('item_tarif.index') }}" class="nav-link" id="item_tarif">
                        <i class="ni ni-money-coins text-success"></i>{{__('Tarif Items')}}
                    </a>
                </div>
                <li class="nav-item">
                    <a class="nav-link" id="alat-menu" href="#navbar-alat" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-alat">
                        <i class="ni ni-briefcase-24" style="color: #c210f8;"></i>
                        <span class="nav-link-text">{{ __('Alat Lab') }}</span>
                    </a>

                    <div class="collapse" id="navbar-alat">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" id="alat-lab-menu" href="{{ route('alat_lab.index') }}">
                                    {{ __('Alat Laboratorium') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="param-alat-menu" href="{{ route('alat_lab_rinci.index') }}">
                                    {{ __('Parameter Alat Lab') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="setting-hasil-menu" href="{{ route('hasil_lab_alat.index') }}">
                                    {{ __('Setting Hasil Alat Lab') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="settings" href="{{ route('setting.index') }}">
                        <i class="ni ni-settings-gear-65 text-dark"></i> {{ __('Pengaturan') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('icons') }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('Icons') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
