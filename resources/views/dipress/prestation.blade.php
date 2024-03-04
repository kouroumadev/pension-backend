@extends('welcome')

@section('body')

<div class="page-header shadow-lg">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>PRESTATIONS</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Acceuil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Liste des Assurances Maladie</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<p>Assurance Maladie</p>
<hr>

<div class="row">

    <div class="col-xl-6 mb-30">
        <a href="{{ route('pension.index') }}" class="btn btn-block">
            <div class="card-box height-100-p widget-style1 bg-success shadow">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="widget-data text-white text-uppercase font-weight-bold text-left">
                        allocation familliale
                    </div>
                    <div class="progress-data">
                        <i class="icon-copy fa fa-wheelchair fa-3x text-white" aria-hidden="true"></i>
                    </div>
                    <small class="pl-1 text-white">Gestion de la situation des pensionnés</small>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-6 mb-30">
        <a href="#" class="btn btn-block">
            <div class="card-box height-100-p widget-style1 bg-success shadow-lg">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="widget-data text-white text-uppercase font-weight-bold text-left">
                        reglement journalieres des femmes salariees en couche
                    </div>
                    <div class="progress-data">
                        <i class="icon-copy fa fa-ambulance fa-3x text-white" aria-hidden="true"></i>
                    </div>
                    <small class="pl-1 text-white">Gestion de la situation des pensionnés</small>
                </div>
            </div>
        </a>
    </div>

    {{-- <div class="col-xl-4 mb-30">
        <a href="#" class="btn btn-block">
            <div class="card-box height-100-p widget-style1 bg-success shadow-lg">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="widget-data text-white text-uppercase font-weight-bold text-left">
                        achat de lunette
                    </div>
                    <div class="progress-data">
                        <i class="icon-copy fa fa-warning fa-3x text-white" aria-hidden="true"></i>
                    </div>
                    <small class="pl-1 text-white">Gestion de la situation des pensionnés</small>
                </div>
            </div>
        </a>
    </div> --}}

</div>





@endsection
