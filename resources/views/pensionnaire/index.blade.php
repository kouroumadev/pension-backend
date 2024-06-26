@extends('welcome')

<style>
    a {
        text-decoration: none !important;
    }

    #card-header-recap-conj1 {
        margin-bottom: 10px;
    }

    #card-header-recap-conj2 {
        background-color: transparent !important;
        color: black;

    }

    a[href="#finish"],
    a[href="#finish"]:hover {
        background-color: transparent !important;
        display: none;
    }
</style>





@section('body')

    <div class="page-header shadow-lg">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>PRESTATIONS</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('prestation.index') }}">Prestations</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @if (isset($type_pension))
                                {{ $type_pension }}
                            @else
                                Gestion des Pensions
                            @endif

                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <hr>
    <form id="form-get-pension" action="{{ route('pensionnaire.info') }}" method="POST">
        <div class="row justify-content-center">

            @csrf
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" id="type_pension" name="type_pension" data-style="btn-outline-success"
                        data-size="5" required>
                        @foreach ($prestations as $pres)
                            <option value="{{ $pres->nom_prestation }}">{{ $pres->nom_prestation }}</option>
                        @endforeach
                        {{-- <option selected>Selectionner le type de pension</option>

                        <option value="reversion">Reversion</option>
                        <option value="Invalidite">Invalidite</option>
                        <option value="allocation de vieillesse">allocation de vieillesse</option>
                        <option value="Deces en Activite">Deces en Activite</option>
                        <option value="Pensions Temporaires d'Orphelin">Pensions Temporaires d'Orphelin</option> --}}

                    </select>
                </div>
            </div>
            <div class="col-md-8">

                <div class="form-row align-items-center">
                    <div class="col-8">
                        <input type="text" class="form-control mb-2" name="no_immatriculation" id="no_immatriculation"
                            placeholder="Entrer le N° d'Immatriculation ou de Pension" required />
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-success mb-2">Rechercher</button>
                    </div>
                </div>

            </div>

        </div>
    </form>
    <hr>

    @if (isset($docs))
        <div class="pb-20">
            <div class="pd-20">
                <h4 class="text-blue h4">Liste des pensionnaires</h4>
            </div>
            <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="DataTables_Table_0"
                role="grid" aria-describedby="DataTables_Table_0_info">
                <thead class="bg-success">
                    <tr>
                        <th class="table-plus text-white">N° Dossier</th>
                        <th class="text-white">Creation</th>
                        <th class="text-white">Rec</th>
                        <th class="text-white">Sortie</th>
                        {{-- <th class="text-white">Etat</th> --}}
                        <th class="text-white">Etat actuel</th>
                        <th class="text-white">Obs</th>
                        <th class="text-white">DeadLine</th>
                        <th class="text-white"> Doc</th>
                        <th class="datatable-nosort text-white">Act</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docs as $key => $doc)
                        @php
                            $current_date = \Carbon\Carbon::parse(\Carbon\Carbon::now());
                            $deadline = \App\Models\Deadline::where('dept_id', Auth::user()->dept_id)->get();
                            $dead_name = $deadline[0]->name;
                            //dd($doc->transfers );
                        @endphp
                        @if ($doc->transfers == null)
                            <tr>
                                <td class=""> <a
                                        href="{{ route('transfert.tracking', $doc->id) }}">{{ $doc->no_dossier }}</a> </td>

                                <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                                <td></td>
                                <td><span class="badge badge-warning">INITIAL...</span></td>
                                {{-- <td><span class="badge badge-warning">Initial...</span></td>  --}}

                                @if ($current_date->diffInDays($doc->created_at) < (int) $dead_name)
                                    <td>
                                        {{ $current_date->diffInDays($doc->created_at) }} <span class="badge "
                                            style=" text-align:center"></span>
                                    </td>
                                @elseif ($current_date->diffInDays($doc->created_at) == (int) $dead_name)
                                    <td>
                                        {{ $current_date->diffInDays($doc->created_at) }} <span class="badge "
                                            style="background-color: rgb(52, 224, 95); text-align:center">à temps</span>
                                    </td>
                                @elseif ($current_date->diffInDays($doc->created_at) > (int) $dead_name)
                                    <td>
                                        {{ $current_date->diffInDays($doc->created_at) }} <span class="badge "
                                            style="background-color: rgb(229, 67, 42); text-align:center"> En retard <span
                                                class="spinner-grow spinner-grow-sm" role="status"
                                                aria-hidden="true"></span></span>
                                    </td>
                                @endif

                                {{-- @if (Auth::user()->dept->id == $deadline[0]->dept_id) --}}
                                <td> {{ $dead_name }} Jour(s)</td>
                                {{-- @endif --}}

                                <td>{{ $doc->type_doc }}</td>


                                @if (Auth::user()->dept->name == 'DQE')
                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('pension.details', $doc->id) }}">Traitement <i
                                                class="fa fa-chevron-right" aria-hidden="true"></i> </a>
                                    </td>
                                @else
                                    <td>
                                        <span>En attente</span>
                                    </td>
                                @endif

                            </tr>
                        @else
                            @php
                                $from = \App\Models\Dept::where('id', $doc->transfers->from_dept)->get();
                                $to = \App\Models\Dept::where('id', $doc->transfers->to_dept)->get();
                                $deadline2 = \App\Models\Deadline::where('dept_id', $doc->transfers->to_dept)->get();
                                if (count($deadline2) > 0) {
                                    $dead_name2 = $deadline2[0]->name;
                                } else {
                                    $dead_name2 = '';
                                }

                            @endphp

                            <tr>
                                <td class=""> <a
                                        href="{{ route('transfert.tracking', $doc->id) }}">{{ $doc->no_dossier }}</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                                <td> <span class="text-success"><i class="icon-copy ion-arrow-right-a"></i></span>
                                    {{ $to[0]->name }}
                                    {{ \Carbon\Carbon::parse($doc->transfers->created_at)->format('d/m/Y') }}</td>
                                <td> <span class="text-danger"><i class="icon-copy ion-arrow-left-a"></i></span>
                                    {{ $from[0]->name }}
                                    {{ \Carbon\Carbon::parse($doc->transfers->created_at)->format('d/m/Y') }}
                                    @if ($doc->transfers->flag_retard == 1)
                                        <span class="text-danger"> retard</span>
                                    @endif
                                </td>
                                {{-- <td><span class="badge badge-warning">{{$from[0]->name}} -> {{$to[0]->name}}</span></td>  --}}
                                <td><span class="badge badge-primary"> {{ $to[0]->name }} <span
                                            class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span></span></td>
                                @if ($current_date->diffInDays($doc->transfers->created_at) < (int) $dead_name2)
                                    <td>
                                        {{ $current_date->diffInDays($doc->transfers->created_at) }} <span class="badge "
                                            style=" text-align:center"></span>
                                    </td>
                                @elseif ($current_date->diffInDays($doc->transfers->created_at) == (int) $dead_name2)
                                    <td>
                                        {{ $current_date->diffInDays($doc->transfers->created_at) }} <span class="badge "
                                            style="background-color: rgb(52, 224, 95); text-align:center">à temps</span>
                                    </td>
                                @elseif ($current_date->diffInDays($doc->transfers->created_at) > (int) $dead_name2)
                                    <td>
                                        {{ $current_date->diffInDays($doc->transfers->created_at) }} <span class="badge "
                                            style="background-color: rgb(229, 67, 42); text-align:center"> En retard <span
                                                class="spinner-grow spinner-grow-sm" role="status"
                                                aria-hidden="true"></span></span>
                                    </td>
                                @endif

                                {{-- @if (Auth::user()->dept->id == $deadline[0]->dept_id) --}}
                                <td> {{ $dead_name2 }} Jour(s)</td>
                                {{-- @endif --}}

                                <td>{{ $doc->type_doc }}</td>

                                @if (Auth::user()->dept->name == $to[0]->name)
                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('pension.details', $doc->id) }}">Traitement <i
                                                class="fa fa-chevron-right" aria-hidden="true"></i> </a>
                                    </td>
                                @else
                                    <td>
                                        <span>En attente</span>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif


    @if (isset($data))


        <div class="row" id="employe-wrapper">
            <div class="col-md-12">
                <div class="pd-20 card-box mb-30 shadow-lg">
                    <div class="wizard-content">
                        <form action="{{ route('pension.store') }}" id="pension-store"
                            class="tab-wizard wizard-circle wizard" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($type_pension == 'AT MORTEL' || $type_pension == 'AT NON MORTEL')
                                <h5>Infos Victime</h5>
                            @else
                                <h5>Infos Personnelles</h5>
                            @endif
                            <section>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Immatriculation :</label>
                                            <input type="text" class="form-control" name="no_ima_employee"
                                                value="{{ $data['employe'][0]->no_employe }}" id="no_immat_disp"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nom :</label>
                                            <input type="text" class="form-control" name="nom_employee"
                                                value="{{ $data['employe'][0]->nom }}" id="nom_employe" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prenom :</label>
                                            <input type="text" class="form-control" name="prenom_employee"
                                                value="{{ $data['employe'][0]->prenoms }}" id="prenom_employe" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date de naissance:</label>
                                            <input type="text" class="form-control" name="date_naissance_employee"
                                                value="{{ $data['employe'][0]->date_naissance }}" id="date_naissance"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lieu de naissance</label>
                                            <input type="text" class="form-control" name="lieu_naissance_employee"
                                                value="{{ $data['employe'][0]->lieu_naissance }}" id="lieu_naissance"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prefecture</label>
                                            <input type="text" class="form-control" name="prefecture_employee"
                                                value="{{ $data['employe'][0]->prefecture }}" id="prefecture" readonly>
                                        </div>
                                    </div>
                                </div>
                                @if ($type_pension == 'REVERSION')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Telephone:</label>
                                                <input type="text" class="form-control" name="tel_employee"
                                                    value="{{ $data['emp_app'][0]->tel_employee }}" readonly
                                                    id="telephone_employe" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Adresse:</label>
                                                <input type="text" class="form-control" name="adresse_employee"
                                                    value="{{ $data['emp_app'][0]->adresse_employee }}" readonly
                                                    id="adresse_employe" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Situation Matrimoniale:</label>
                                                <input type="text" class="form-control"
                                                    name="situation_matri_employee"
                                                    value="{{ $data['employe'][0]->statut }}" id="statut" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Photo du Pensionnaire</label>
                                                {{-- <input type="file" name="pensionnaire_photo" class="form-control-file"
                                                    id="exampleFormControlFile1" onchange="readURL(this)" required> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/pensionnaireImg/' . $data['emp_app'][0]->photo) }}"
                                                class="rounded" alt="No Image" id="img" style='height:150px; vis'>
                                            <br>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Telephone:</label>
                                                <input type="text" class="form-control" name="tel_employee"
                                                    id="telephone_employe" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Adresse:</label>
                                                <input type="text" class="form-control" name="adresse_employee"
                                                    id="adresse_employe" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Situation Matrimoniale:</label>
                                                <input type="text" class="form-control"
                                                    name="situation_matri_employee"
                                                    value="{{ $data['employe'][0]->statut }}" id="statut" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Photo du Pensionnaire</label>
                                                <input type="file" name="pensionnaire_photo" class="form-control-file"
                                                    id="exampleFormControlFile1" onchange="readURL(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="" class="rounded" alt="No Image" id="img"
                                                style='height:150px;'> <br>
                                        </div>
                                    </div>
                                @endif


                            </section>
                            {{-- if and only type pension is at mortel ou non --}}
                            @if ($type_pension == 'AT MORTEL' || $type_pension == 'AT NON MORTEL')
                                <h5>Accident Info</h5>
                                <section>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>type accident:</label>
                                                <input type="text" class="form-control" name="type_accident"
                                                    value="{{ $type_pension }}" id="type_accident_disp" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>date d'accident :</label>
                                                <input type="text" class="form-control date-picker"
                                                    name="date_accident" value="" id="date_accident">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>heure Accident :</label>
                                                <input class="form-control time-picker-default td-input"
                                                    placeholder="time" type="text" name="heure_accident"
                                                    value="" id="heure_accident" readonly="">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>date décès :</label>
                                                <input type="text" class="form-control date-picker" name="date_deces"
                                                    value="" id="date_deces">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Agent Materiel:</label>
                                                <input type="text" class="form-control" name="agent_materiel"
                                                    value="" id="agent_materiel">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nature lésions</label>
                                                <input type="text" class="form-control" name="nature_lesion"
                                                    value="" id="nature_lesion">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Conséquences</label>
                                                <select class="custom-select col-12" name="consequence">
                                                    <option selected="">Choose...</option>
                                                    <option value="sans arret de travail">sans arret de travail</option>
                                                    <option value="avec arret de travail">avec arret de travail</option>
                                                    <option value="deces">décès</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nom Témoin:</label>
                                                <input type="text" class="form-control" name="nom_temoin"
                                                    value="" id="nom_temoin_disp" placeholder="nom">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Prenom Témoin:</label>
                                                <input type="text" class="form-control" placeholder="prenom"
                                                    name="prenom_temoin" value="" id="prenom_temoin">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Adresse Témoin:</label>
                                                <input class="form-control" placeholder="adresse" type="text"
                                                    name="adresse_temoin" value="" id="adresse_temoin"
                                                    placeholder="adresse">

                                            </div>
                                        </div>
                                    </div>


                                </section>
                            @endif
                            <!-- Step 2 -->
                            <h5>Infos Employeur</h5>
                            <section>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Employeur :</label>
                                            <input type="text" class="form-control" name="no_employer"
                                                value="{{ $data['employeur'][0]->no_employeur }}" id="no_employeur"
                                                readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Raison Sociale :</label>
                                            <input class="form-control" cols="2" name="raison_sociale"
                                                value="{{ $data['employeur'][0]->raison_sociale }}" id="raison_sociale"
                                                readonly />


                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Categorie :</label>
                                            <input type="text" class="form-control" name="category"
                                                value="{{ $data['employeur'][0]->categorie }}" id="categorie" readonly />
                                        </div>
                                    </div>
                                </div>


                            </section>
                            <!-- Step 3 -->
                            <h5>Conjoints et Enfants</h5>
                            <section>

                                <?php
                                $details = json_encode($data['employeDetails']);
                                ?>

                                <input type="hidden" name="details" value="{{ $details }}">
                                <input type="hidden" name="type_pension" value="{{ $type_pension }}">

                                @if ($data['employeDetails'] == null)
                                    <h4 style="text-align: center">Pas de Conjoint</h4>
                                @else
                                    <div class="faq-wrap">
                                        @foreach ($data['employeDetails'] as $key => $value)
                                            <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="btn btn-block text-bold" data-toggle="collapse"
                                                            data-target="faq{{ $key }}">
                                                            <span class="text-bold">Conjoint(e) {{ $key + 1 }} -
                                                                {{ strtoupper($value['conjoint_name']) }}
                                                                {{ strtoupper($value['conjoint_prenom']) }} </span>
                                                        </div>
                                                    </div>
                                                    <div id="faq{{ $key }}" class="collapse show"
                                                        data-parent="accordion">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Nom</th>
                                                                        <th scope="col">Prenom</th>
                                                                        <th scope="col">date de Naissance</th>
                                                                        <th scope="col">Lieu de Naissance</th>
                                                                        <th scope="col">Ordre de Naissance</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <h5 class="text-center p-3">Liste des enfants</h5>
                                                                    @foreach ($value['enfants'] as $key => $enfant)
                                                                        @if ($enfant == null)
                                                                            <div class="alert alert-secondary"
                                                                                role="alert">
                                                                                Pas d'enfants
                                                                            </div>
                                                                        @else
                                                                            <tr>
                                                                                <th scope="row">{{ $key + 1 }}
                                                                                </th>
                                                                                <td>{{ $enfant->nom }}</td>
                                                                                <td>{{ $enfant->prenoms }}</td>
                                                                                <td>{{ $enfant->date_naissance }}</td>
                                                                                <td>{{ $enfant->lieu_naissance }}</td>
                                                                                <td>{{ $enfant->ordre }}</td>

                                                                            </tr>
                                                                        @endif
                                                                    @endforeach


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                @endif


                            </section>
                            <!-- Step 4 -->
                            <h5>Infos Deposant</h5>
                            <section class="mb-2">
                                <div class="row">
                                    <div class="col-md-3 font-weight-bold">
                                        Charger les infos du Pensionnaire
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <div class="checkbox checbox-switch switch-primary">
                                                <label>
                                                    <input type="checkbox" name="sameGuy" id="sameGuy"
                                                        data-color="#498e54" onclick="loadDeposant()">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nom</label>
                                            <input type="text" class="form-control" id="nom_deposant"
                                                name="nom_deposant" placeholder="Entrer le nom">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prenom</label>
                                            <input type="text" class="form-control" id="prenom_deposant"
                                                name="prenom_deposant" placeholder="Entrer le premom">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input type="text" class="form-control" name="telephone_deposant"
                                                placeholder="Entrer le Numero de telephone" id="telephone_deposant">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Adresse</label>
                                            <input type="text" class="form-control" name="adresse_deposant"
                                                placeholder="Entrer l'adresse" id="adresse_deposant">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CIN</label>
                                            <input type="text" class="form-control" name="cin_deposant"
                                                placeholder="Entrer CIN" id="cin_deposant">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email_deposant"
                                                placeholder="Entrer email" id="email_deposant" onblur="recapDeposant()">
                                        </div>
                                    </div>

                                </div>
                            </section>
                            <!-- Step 5 -->
                            <h5>Documents</h5>
                            <section>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Pièces a Fournir</th>
                                                    <th scope="col">Charger le fichier</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $retraite = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'RETRAITE',
                                                    )->get();
                                                    $retraite_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $retraite[0]->id,
                                                    )->get();
                                                    $reversion = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'REVERSION',
                                                    )->get();
                                                    $reversion_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $reversion[0]->id,
                                                    )->get();
                                                    $invalidite = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'INVALIDITE',
                                                    )->get();
                                                    $invalidite_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $invalidite[0]->id,
                                                    )->get();
                                                    $deces_en_activite = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'DECES EN ACTIVITE',
                                                    )->get();
                                                    $deces_en_activite_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $deces_en_activite[0]->id,
                                                    )->get();
                                                    $allocation_de_veillesse = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'ALLOCATION DE VEILLESSE',
                                                    )->get();
                                                    $allocation_de_veillesse_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $allocation_de_veillesse[0]->id,
                                                    )->get();
                                                    $pension_tempo_orph = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'PENSION TEMPORAIRES ORPHELIN ',
                                                    )->get();
                                                    $pension_tempo_orph_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $pension_tempo_orph[0]->id,
                                                    )->get();
                                                    $at_mortel = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'AT MORTEL',
                                                    )->get();
                                                    $at_mortel_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $at_mortel[0]->id,
                                                    )->get();
                                                    $at_non_mortel = \App\Models\Prestation::where(
                                                        'nom_prestation',
                                                        'AT MORTEL',
                                                    )->get();
                                                    $at_non_mortel_doc = \App\Models\Piece::where(
                                                        'prestation_id',
                                                        $at_non_mortel[0]->id,
                                                    )->get();
                                                    // dd($retraite_doc);
                                                @endphp
                                                @if ($type_pension == 'RETRAITE')
                                                    @foreach ($retraite_doc as $key => $item)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <th scope="row">{{ $item->nom_piece }}
                                                                @if ($item->obligation == '1')
                                                                    <span class="text-danger">*</span>
                                                                @endif

                                                            </th>
                                                            <input type="hidden" name="titles[]"
                                                                value="{{ $item->nom_piece }}">
                                                            <th scope="row">
                                                                @if ($item->obligation == '1')
                                                                    <input type="file" id="file{{ $key }}"
                                                                        name="files[]" accept="application/pdf"
                                                                        class="form-control-file form-control height-auto"
                                                                        data-toggle="modal"
                                                                        data-target="#bd-example-modal-lg"
                                                                        onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')"
                                                                        required />
                                                                @else
                                                                    <input type="file" id="file{{ $key }}"
                                                                        name="files[]" accept="application/pdf"
                                                                        class="form-control-file form-control height-auto"
                                                                        data-toggle="modal"
                                                                        data-target="#bd-example-modal-lg"
                                                                        onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')" />
                                                                @endif

                                                            </th>
                                                            <th scope="row" id="file{{ $key }}_statut"><span
                                                                    class="badge badge-danger"><i
                                                                        class="icon-copy fa fa-warning"
                                                                        aria-hidden="true"></i> Non Chargé</span></th>
                                                        </tr>
                                                    @endforeach
                                                @elseif ($type_pension == 'REVERSION')
                                                    @foreach ($reversion_doc as $key => $item)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <th scope="row">{{ $item->nom_piece }}
                                                                @if ($item->obligation == '1')
                                                                    <span class="text-danger">*</span>
                                                                @endif

                                                            </th>
                                                            <input type="hidden" name="titles[]"
                                                                value="{{ $item->nom_piece }}">
                                                            <th scope="row"><input type="file"
                                                                    id="file{{ $key }}" name="files[]"
                                                                    accept="application/pdf"
                                                                    class="form-control-file form-control height-auto"
                                                                    data-toggle="modal" data-target="#bd-example-modal-lg"
                                                                    onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')"
                                                                    required /></th>
                                                            <th scope="row" id="file{{ $key }}_statut"><span
                                                                    class="badge badge-danger"><i
                                                                        class="icon-copy fa fa-warning"
                                                                        aria-hidden="true"></i> Non Chargé</span></th>
                                                        </tr>
                                                    @endforeach
                                                @elseif ($type_pension == 'INVALIDITE')
                                                    @foreach ($invalidite_doc as $key => $item)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <th scope="row">{{ $item->nom_piece }}
                                                                @if ($item->obligation == '1')
                                                                    <span class="text-danger">*</span>
                                                                @endif

                                                            </th>
                                                            <input type="hidden" name="titles[]"
                                                                value="{{ $item->nom_piece }}">
                                                            <th scope="row"><input type="file"
                                                                    id="file{{ $key }}" name="files[]"
                                                                    accept="application/pdf"
                                                                    class="form-control-file form-control height-auto"
                                                                    data-toggle="modal" data-target="#bd-example-modal-lg"
                                                                    onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')"
                                                                    required /></th>
                                                            <th scope="row" id="file{{ $key }}_statut"><span
                                                                    class="badge badge-danger"><i
                                                                        class="icon-copy fa fa-warning"
                                                                        aria-hidden="true"></i> Non Chargé</span></th>
                                                        </tr>
                                                    @endforeach
                                                @elseif ($type_pension == 'ALLOCATION DE VEILLESSE')
                                                    @foreach ($allocation_de_veillesse_doc as $key => $item)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <th scope="row">{{ $item->nom_piece }}
                                                                @if ($item->obligation == '1')
                                                                    <span class="text-danger">*</span>
                                                                @endif

                                                            </th>
                                                            <input type="hidden" name="titles[]"
                                                                value="{{ $item->nom_piece }}">
                                                            <th scope="row"><input type="file"
                                                                    id="file{{ $key }}" name="files[]"
                                                                    accept="application/pdf"
                                                                    class="form-control-file form-control height-auto"
                                                                    data-toggle="modal" data-target="#bd-example-modal-lg"
                                                                    onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')"
                                                                    required /></th>
                                                            <th scope="row" id="file{{ $key }}_statut"><span
                                                                    class="badge badge-danger"><i
                                                                        class="icon-copy fa fa-warning"
                                                                        aria-hidden="true"></i> Non Chargé</span></th>
                                                        </tr>
                                                    @endforeach
                                                @elseif ($type_pension == 'DECES EN ACTIVITE')
                                                    @foreach ($deces_en_activite_doc as $key => $item)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <th scope="row">{{ $item->nom_piece }}
                                                                @if ($item->obligation == '1')
                                                                    <span class="text-danger">*</span>
                                                                @endif

                                                            </th>
                                                            <input type="hidden" name="titles[]"
                                                                value="{{ $item->nom_piece }}">
                                                            <th scope="row"><input type="file"
                                                                    id="file{{ $key }}" name="files[]"
                                                                    accept="application/pdf"
                                                                    class="form-control-file form-control height-auto"
                                                                    data-toggle="modal" data-target="#bd-example-modal-lg"
                                                                    onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')"
                                                                    required /></th>
                                                            <th scope="row" id="file{{ $key }}_statut"><span
                                                                    class="badge badge-danger"><i
                                                                        class="icon-copy fa fa-warning"
                                                                        aria-hidden="true"></i> Non Chargé</span></th>
                                                        </tr>
                                                    @endforeach
                                                @elseif ($type_pension == 'PENSION TEMPORAIRES ORPHELIN')
                                                    @foreach ($pension_tempo_orph_doc as $key => $item)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <th scope="row">{{ $item->nom_piece }}
                                                                @if ($item->obligation == '1')
                                                                    <span class="text-danger">*</span>
                                                                @endif

                                                            </th>
                                                            <input type="hidden" name="titles[]"
                                                                value="{{ $item->nom_piece }}">
                                                            <th scope="row"><input type="file"
                                                                    id="file{{ $key }}" name="files[]"
                                                                    accept="application/pdf"
                                                                    class="form-control-file form-control height-auto"
                                                                    data-toggle="modal" data-target="#bd-example-modal-lg"
                                                                    onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')"
                                                                    required /></th>
                                                            <th scope="row" id="file{{ $key }}_statut"><span
                                                                    class="badge badge-danger"><i
                                                                        class="icon-copy fa fa-warning"
                                                                        aria-hidden="true"></i> Non Chargé</span></th>
                                                        </tr>
                                                    @endforeach
                                                @elseif ($type_pension == 'AT MORTEL' || $type_pension == 'AT NON MORTEL')
                                                    @foreach ($at_mortel_doc as $key => $item)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <th scope="row">{{ $item->nom_piece }}
                                                                @if ($item->obligation == '1')
                                                                    <span class="text-danger">*</span>
                                                                @endif

                                                            </th>
                                                            <input type="hidden" name="titles[]"
                                                                value="{{ $item->nom_piece }}">
                                                            <th scope="row"><input type="file"
                                                                    id="file{{ $key }}" name="files[]"
                                                                    accept="application/pdf"
                                                                    class="form-control-file form-control height-auto"
                                                                    data-toggle="modal" data-target="#bd-example-modal-lg"
                                                                    onchange="myFunction('file{{ $key }}','file{{ $key }}_statut')"
                                                                    required /></th>
                                                            <th scope="row" id="file{{ $key }}_statut">
                                                                <span class="badge badge-danger"><i
                                                                        class="icon-copy fa fa-warning"
                                                                        aria-hidden="true"></i> Non Chargé</span>
                                                            </th>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 6 -->
                            <h5>Recap</h5>
                            <section>

                                <div class="faq-wrap">

                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                                                    <strong>INFOS PERSONNELLES</strong>
                                                </div>
                                            </div>
                                            <div id="faq1" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th>No Employe</th>
                                                                <td>{{ $data['employe'][0]->no_employe }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Prenom</th>
                                                                <td>{{ $data['employe'][0]->prenoms }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nom</th>
                                                                <td>{{ $data['employe'][0]->nom }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Date de Naissance</th>
                                                                <td>{{ $data['employe'][0]->date_naissance }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Lieu de Naissance</th>
                                                                <td>{{ $data['employe'][0]->lieu_naissance }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="btn btn-block" data-toggle="collapse" data-target="#faq2">
                                                    <strong>INFOS EMPLOYEUR</strong>
                                                </div>
                                            </div>
                                            <div id="faq2" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th>No Employeur</th>
                                                                <td>{{ $data['employeur'][0]->no_employeur }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Raison Sociale</th>
                                                                <td>{{ $data['employeur'][0]->raison_sociale }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Categorie</th>
                                                                <td>{{ $data['employeur'][0]->categorie }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="card-header-recap-conj1">
                                                <div class="btn btn-block" data-toggle="collapse" data-target="#faq2">
                                                    <strong>INFOS CONJOINTS ET ENFANTS</strong>
                                                </div>
                                            </div>
                                            <div class="faq-wrap">
                                                @foreach ($data['employeDetails'] as $key => $value)
                                                    <div id="accordion">
                                                        <div class="card">
                                                            <div class="card-header" id="card-header-recap-conj2">
                                                                <div class="btn btn-block" data-toggle="collapse"
                                                                    data-target="faq{{ $key }}">
                                                                    <span class="text-bold">Conjoint(e)
                                                                        {{ $key + 1 }} -
                                                                        {{ strtoupper($value['conjoint_name']) }}
                                                                        {{ strtoupper($value['conjoint_prenom']) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div id="faq{{ $key }}" class="collapse show"
                                                                data-parent="accordion">
                                                                <div class="card-body">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Nom</th>
                                                                                <th scope="col">Prenom</th>
                                                                                <th scope="col">date de Naissance</th>
                                                                                <th scope="col">Lieu de Naissance</th>
                                                                                <th scope="col">Ordre de Naissance</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <h5 class="text-center">Liste des enfants</h5>
                                                                            @foreach ($value['enfants'] as $key => $enfant)
                                                                                @if ($enfant == null)
                                                                                    <div class="alert alert-secondary"
                                                                                        role="alert">
                                                                                        Pas d'enfants
                                                                                    </div>
                                                                                @else
                                                                                    <tr>
                                                                                        <th scope="row">
                                                                                            {{ $key + 1 }}</th>
                                                                                        <td>{{ $enfant->nom }}</td>
                                                                                        <td>{{ $enfant->prenoms }}</td>
                                                                                        <td>{{ $enfant->date_naissance }}
                                                                                        </td>
                                                                                        <td>{{ $enfant->lieu_naissance }}
                                                                                        </td>
                                                                                        <td>{{ $enfant->ordre }}</td>

                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach


                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <div class="btn btn-block" data-toggle="collapse" data-target="#faq2">
                                                    <strong>INFOS DEPOSANT</strong>
                                                </div>
                                            </div>
                                            <div id="faq2" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Nom déposant</th>
                                                                <td id="nom_dep"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Prenom déposant</th>
                                                                <td id="prenom_dep"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Téléphone déposant</th>
                                                                <td id="tel_dep"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email déposant</th>
                                                                <td id="email_dep"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Adresse déposant</th>
                                                                <td id="adr_dep"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>CIN déposant</th>
                                                                <td id="cin_dep"></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </section>
                            <input type="hidden" name="code_employe" value="{{ $data['employe'][0]->code_employe }}"
                                id="">
                            <input type="hidden" name="date_jour" value="{{ $data['employe'][0]->date_jour }}"
                                id="">
                            <input type="hidden" name="date_embauche" value="{{ $data['employe'][0]->date_embauche }}"
                                id="">
                            <input type="hidden" name="date_etabl_cin"
                                value="{{ $data['employe'][0]->date_etabl_cin }}" id="">
                            <input type="hidden" name="date_immatriculation"
                                value="{{ $data['employe'][0]->date_immatriculation }}" id="">
                            <input type="hidden" name="datemodification"
                                value="{{ $data['employe'][0]->datemodification }}" id="">
                            <input type="hidden" name="employeur_id" value="{{ $data['employe'][0]->employeur_id }}"
                                id="">
                            <input type="hidden" name="lieu_etab_cin" value="{{ $data['employe'][0]->lieu_etab_cin }}"
                                id="">
                            <input type="hidden" name="nationalite" value="{{ $data['employe'][0]->nationalite }}"
                                id="">
                            <input type="hidden" name="date_created" value="{{ $data['employe'][0]->date_created }}"
                                id="">
                            <input type="hidden" name="no_cin" value="{{ $data['employe'][0]->no_cin }}"
                                id="">
                            <input type="hidden" name="nom_mere" value="{{ $data['employe'][0]->nom_mere }}"
                                id="">
                            <input type="hidden" name="nom_pere" value="{{ $data['employe'][0]->nom_pere }}"
                                id="">
                            <input type="hidden" name="pays_id" value="{{ $data['employe'][0]->pays_id }}"
                                id="">
                            <input type="hidden" name="prefecture" value="{{ $data['employe'][0]->prefecture }}"
                                id="">
                            <input type="hidden" name="prenom_mere" value="{{ $data['employe'][0]->prenom_mere }}"
                                id="">
                            <input type="hidden" name="prenom_pere" value="{{ $data['employe'][0]->prenom_pere }}"
                                id="">
                            <input type="hidden" name="no_employeur" value="{{ $data['employe'][0]->no_employeur }}"
                                id="">
                            <input type="hidden" name="profession" value="{{ $data['employe'][0]->profession }}"
                                id="">
                            <input type="hidden" name="sexe" value="{{ $data['employe'][0]->sexe }}"
                                id="">
                            <input type="hidden" name="situationpro" value="{{ $data['employe'][0]->situationpro }}"
                                id="">
                            <input type="hidden" name="statut" value="{{ $data['employe'][0]->statut }}"
                                id="">
                            <input type="hidden" name="statut_employe_id"
                                value="{{ $data['employe'][0]->statut_employe_id }}" id="">
                            <input type="hidden" name="adresse" value="{{ $data['employe'][0]->adresse }}"
                                id="">
                            <input type="hidden" name="anciencode_employeur"
                                value="{{ $data['employe'][0]->anciencode_employeur }}" id="">
                            <input type="hidden" name="ancien_num_employe"
                                value="{{ $data['employe'][0]->ancien_num_employe }}" id="">
                            <input type="hidden" name="datesortie" value="{{ $data['employe'][0]->datesortie }}"
                                id="">
                            <input type="hidden" name="tag_rattrapage"
                                value="{{ $data['employe'][0]->tag_rattrapage }}" id="">
                            <input type="hidden" name="user_id" value="{{ $data['employe'][0]->user_id }}"
                                id="">
                            <input type="hidden" name="categorie_id" value="{{ $data['employe'][0]->categorie_id }}"
                                id="">
                            <input type="hidden" name="tag_deces" value="{{ $data['employe'][0]->tag_deces }}"
                                id="">
                            <input type="hidden" name="tag_invalidite"
                                value="{{ $data['employe'][0]->tag_invalidite }}" id="">
                            <input type="hidden" name="tag_compte_indiv"
                                value="{{ $data['employe'][0]->tag_compte_indiv }}" id="">
                            <input type="hidden" name="tag_statut" value="{{ $data['employe'][0]->tag_statut }}"
                                id="">
                            <input type="hidden" name="tag_famille" value="{{ $data['employe'][0]->tag_famille }}"
                                id="">
                            <input type="hidden" name="prefecture_id" value="{{ $data['employe'][0]->prefecture_id }}"
                                id="">
                            <input type="hidden" name="code_prefecture"
                                value="{{ $data['employe'][0]->code_prefecture }}" id="">
                            <input type="hidden" name="pref_id" value="{{ $data['employe'][0]->pref_id }}"
                                id="">
                            <input type="hidden" name="agen_id" value="{{ $data['employe'][0]->agen_id }}"
                                id="">
                            <input type="hidden" name="agencecode_id" value="{{ $data['employe'][0]->agencecode_id }}"
                                id="">
                            <input type="hidden" name="tag_allocfam" value="{{ $data['employe'][0]->tag_allocfam }}"
                                id="">
                            <input type="hidden" name="tag_famille_pf"
                                value="{{ $data['employe'][0]->tag_famille_pf }}" id="">
                            <input type="hidden" name="tag_allocprepost"
                                value="{{ $data['employe'][0]->tag_allocprepost }}" id="">
                            <input type="hidden" name="tag_ijcongemat"
                                value="{{ $data['employe'][0]->tag_ijcongemat }}" id="">
                            <input type="hidden" name="tag_alloc_chomage"
                                value="{{ $data['employe'][0]->tag_alloc_chomage }}" id="">
                            <input type="hidden" name="tag_allocataire_pf"
                                value="{{ $data['employe'][0]->tag_allocataire_pf }}" id="">
                            <input type="hidden" name="tag_retraite" value="{{ $data['employe'][0]->tag_retraite }}"
                                id="">
                            <input type="hidden" name="age_reel_deces"
                                value="{{ $data['employe'][0]->age_reel_deces }}" id="">
                            <input type="hidden" name="assignation_id"
                                value="{{ $data['employe'][0]->assignation_id }}" id="">
                            <input type="hidden" name="date_deces" value="{{ $data['employe'][0]->date_deces }}"
                                id="">
                            <input type="hidden" name="no_acte_deces" value="{{ $data['employe'][0]->no_acte_deces }}"
                                id="">
                            <input type="hidden" name="tag_famille_rp"
                                value="{{ $data['employe'][0]->tag_famille_rp }}" id="">
                            <input type="hidden" name="tag_rente_deces"
                                value="{{ $data['employe'][0]->tag_rente_deces }}" id="">
                            <input type="hidden" name="tag_suspension"
                                value="{{ $data['employe'][0]->tag_suspension }}" id="">
                            <input type="hidden" name="matricule" value="{{ $data['employe'][0]->matricule }}"
                                id="">

                            <button type="submit" class="btn btn-success">Envoyer</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector("#img").setAttribute("src", e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <script>
            function loadDeposant() {
                if (document.getElementById('sameGuy').checked) {
                    var nom = {!! json_encode($data['employe'][0]->nom) !!};
                    var prenom = {!! json_encode($data['employe'][0]->prenoms) !!};
                    var telephone_emp = document.getElementById("telephone_employe").value;
                    var adresse_emp = document.getElementById("adresse_employe").value;

                    document.getElementById("nom_deposant").value = nom;
                    document.getElementById("prenom_deposant").value = prenom;
                    document.getElementById("telephone_deposant").value = telephone_emp;
                    document.getElementById("adresse_deposant").value = adresse_emp;
                } else {
                    document.getElementById("nom_deposant").value = "";
                    document.getElementById("prenom_deposant").value = "";
                    document.getElementById("telephone_deposant").value = "";
                    document.getElementById("adresse_deposant").value = "";
                }
            }

            function recapDeposant() {
                var nom_deposant = document.getElementById("nom_deposant").value
                var prenom_deposant = document.getElementById("prenom_deposant").value
                var telephone_deposant = document.getElementById("telephone_deposant").value
                var adresse_deposant = document.getElementById("adresse_deposant").value
                var email_deposant = document.getElementById("email_deposant").value
                var cin_deposant = document.getElementById("cin_deposant").value
                //alert(nom_deposant);
                document.getElementById("nom_dep").innerHTML = nom_deposant;
                document.getElementById("prenom_dep").innerHTML = prenom_deposant;
                document.getElementById("tel_dep").innerHTML = telephone_deposant;
                document.getElementById("adr_dep").innerHTML = adresse_deposant;
                document.getElementById("cin_dep").innerHTML = cin_deposant;
                document.getElementById("email_dep").innerHTML = email_deposant;
            }
        </script>

        <script>
            function myFunction(file, status) {

                if (file != '') {


                    document.getElementById(status).innerHTML =
                        '<span class="bg-success p-2 rounded text-white"><i class="icon-copy fa fa-thumbs-up" aria-hidden="true"></i> Chargé</span>';
                }
            }
        </script>

    @endif


@endsection
