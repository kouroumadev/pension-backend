@extends('welcome')

<style>
    a {
        text-decoration: none !important;
    }
    #card-header-recap-conj1{
        margin-bottom: 10px;
    }
    #card-header-recap-conj2{
        background-color: transparent !important;
        color: black;

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
            <select class="form-control" id="type_pension" name="type_pension" data-style="btn-outline-success" data-size="5" required>
                <option  selected>Selectionner le type de pension</option>
                <option value="Retraite">Retraite</option>
                <option value="reversion">Reversion</option>
                <option value="Invalidite">Invalidite</option>
                <option value="allocation de vieillesse">allocation de vieillesse</option>
                <option value="Deces en Activite">Deces en Activite</option>
                <option value="Pensions Temporaires d'Orphelin">Pensions Temporaires d'Orphelin</option>

            </select>
        </div>
    </div>
    <div class="col-md-8">

            <div class="form-row align-items-center">
                <div class="col-8">
                    <input type="text" class="form-control mb-2" name="no_immatriculation" id="no_immatriculation" placeholder="Entrer le N° d'Immatriculation ou de Pension" required />
                </div>

                <div class="col-auto">
                <button type="submit" class="btn btn-success mb-2">Rechercher</button>
                </div>
            </div>

    </div>

</div>
</form>
<hr>

@if (isset($emps))

<div class="pb-20">
    <div class="pd-20">
        <h4 class="text-blue h4">Liste des pensionnaires</h4>
    </div>
    <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline"
    id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
        <thead class="bg-success">
            <tr>
                <th class="table-plus text-white">Immat.</th>
                <th class="text-white">Prenom & Nom</th>
                <th class="text-white">Raison Sociale</th>
                <th class="text-white">Date Creation</th>
                <th class="text-white">Etat</th>
                <th class="text-white">Etape</th>
                <th class="datatable-nosort text-white">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emps as $emp)
            <tr>
                <td class="">{{ $emp->no_ima_employee }}</td>
                <td class="">{{ $emp->prenom_employee }} <span class="text-uppercase">{{ $emp->nom_employee }}</span></td>
                <td>{{ $emp->employer->raison_sociale }}</td>
                <td>{{ $emp->created_at }}</td>
                <td><span class="badge badge-warning">En Cours...</span></td>
                <td>DCG</td>
                <td>
                    <a class="btn btn-success" href="{{ route('pension.details',$emp->id) }}">Traitement <i class="fa fa-chevron-right" aria-hidden="true"></i> </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endif


@if(isset($data))


    <div class="row" id="employe-wrapper">
        <div class="col-md-12">
            <div class="pd-20 card-box mb-30 shadow-lg">
                <div class="wizard-content">
                    <form action="{{ route('pension.store') }}" class="tab-wizard wizard-circle wizard" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5>Infos Personnelles</h5>
                        <section>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Immatriculation :</label>
                                        <input type="text" class="form-control" name="no_ima_employee"
                                            value="{{ $data['employe'][0]->no_employe }}" id="no_immat_disp" readonly>
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
                                            value="{{ $data['employe'][0]->date_naissance }}" id="date_naissance" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lieu de naissance</label>
                                        <input type="text" class="form-control" name="lieu_naissance_employee"
                                            value="{{ $data['employe'][0]->lieu_naissance }}" id="lieu_naissance" readonly>
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
                                        <input type="text" class="form-control" name="situation_matri_employee"
                                            value="{{ $data['employe'][0]->statut }}" id="statut" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Photo du Pensionnaire</label>
                                        <input type="file" name="pensionnaire_photo" class="form-control-file" id="exampleFormControlFile1" onchange="readURL(this)" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="" class="rounded" alt="No Image" id="img" style='height:150px;'> <br>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h5>Infos Employeur</h5>
                        <section>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Employeur :</label>
                                        <input type="text" class="form-control" name="no_employer"
                                            value="{{ $data['employeur'][0]->no_employeur }}" id="no_employeur" readonly />
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


                            <div class="faq-wrap">
                                @foreach ($data['employeDetails'] as $key => $value)
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="btn btn-block" data-toggle="collapse" data-target="faq{{ $key }}">
                                            Conjoint(e) {{ $key+1}} - {{ $value['conjoint_name'] }} {{ $value['conjoint_prenom'] }}
                                            </div>
                                        </div>
                                        <div id="faq{{ $key }}" class="collapse show" data-parent="accordion">
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
                                                        @foreach ($value['enfants'] as $key => $enfant)
                                                            @if ($enfant == null)
                                                                <div class="alert alert-secondary" role="alert">
                                                                    Pas d'enfants
                                                                </div>
                                                            @else
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
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
                                                <input type="checkbox" name="sameGuy" id="sameGuy" data-color="#498e54" onclick="loadDeposant()">
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
                                        <input type="text" class="form-control" id="nom_deposant" name="nom_deposant"
                                            placeholder="Entrer le nom">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Prenom</label>
                                        <input type="text" class="form-control" id="prenom_deposant" name="prenom_deposant"
                                            placeholder="Entrer le premom">
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
                                            placeholder="Entrer CIN">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email_deposant"
                                            placeholder="Entrer email" onblur="recapDeposant()">
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telephone</label>
                                    <input type="text" class="form-control" name="telephone_deposant" placeholder="Entrer le Numero de telephone">
                                </div>
                            </div> --}}
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
                                            @if ($type_pension == "Retraite")
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <th scope="row">Lettre de transmission faite par l'employeur ou le beneficiaire adressée au DG</th>
                                                    <input type="hidden" name="titles[]" value="Lettre de transmission faite par l'employeur ou le beneficiaire adressée au DG">
                                                    <th scope="row"><input type="file" id="file1" name="files[]" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg"   onchange="myFunction('file1','file1_statut')" /></th>
                                                    <th scope="row" id="file1_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <th scope="row">Le carnet d'assuré social ou la carte d'assuré social</th>
                                                    <input type="hidden" name="titles[]" value="Le carnet d'assuré social ou la carte d'assuré social">
                                                    <th scope="row"><input type="file" name="files[]"  id="file2" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file2','file2_statut')"></th>
                                                    <th scope="row" id="file2_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <th scope="row">Le certificat de travail avec la date d'embauche</th>
                                                    <input type="hidden" name="titles[]" value="Le certificat de travail avec la date d'embauche">
                                                    <th scope="row"><input type="file" name="files[]"  id="file3" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file3','file3_statut')"></th>
                                                    <th scope="row" id="file3_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <th scope="row">Le certificat de cessation de paiement avec le dernier salaire (CCP)</th>
                                                    <input type="hidden" name="titles[]" value="Le certificat de cessation de paiement avec le dernier salaire (CCP)">
                                                    <th scope="row"><input type="file" name="files[]"  id="file4" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file4','file4_statut')"></th>
                                                    <th scope="row" id="file4_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <th scope="row">Le releve des 120 derniers mois (10 dernieres annees)</th>
                                                    <input type="hidden" name="titles[]" value="Le releve des 120 derniers mois (10 dernieres annees)">
                                                    <th scope="row"><input type="file" name="files[]"  id="file5" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file5','file5_statut')"></th>
                                                    <th scope="row" id="file5_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">6</th>
                                                    <th scope="row">Porces-verbale du conseil de famille</th>
                                                    <input type="hidden" name="titles[]" value="Porces-verbale du conseil de famille">
                                                    <th scope="row"><input type="file" name="files[]"  id="file6" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file6','file6_statut')"></th>
                                                    <th scope="row" id="file6_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">7</th>
                                                    <th scope="row">Le jugement d'heredite</th>
                                                    <input type="hidden" name="titles[]" value="Le jugement d'heredite">
                                                    <th scope="row"><input type="file" name="files[]"  id="file7" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file7','file7_statut')"></th>
                                                    <th scope="row" id="file7_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">8</th>
                                                    <th scope="row">Le certificat de residence du veuf, de la veuve ou des veuves</th>
                                                    <input type="hidden" name="titles[]" value="Le certificat de residence du veuf, de la veuve ou des veuves">
                                                    <th scope="row"><input type="file" name="files[]"  id="file8" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file8','file8_statut')"></th>
                                                    <th scope="row" id="file8_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">9</th>
                                                    <th scope="row">Quatre(4) photos d'identite du veuf, de la veuve ou des veuves</th>
                                                    <input type="hidden" name="titles[]" value="Quatre(4) photos d'identite du veuf, de la veuve ou des veuves">
                                                    <th scope="row"><input type="file" name="files[]"  id="file9" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file9','file9_statut')"></th>
                                                    <th scope="row" id="file9_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">10</th>
                                                    <th scope="row">La photocopie recto-verso de la carte d'identite nationale</th>
                                                    <input type="hidden" name="titles[]" value="La photocopie recto-verso de la carte d'identite nationale">
                                                    <th scope="row"><input type="file" name="files[]"  id="file10" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file10','file10_statut')"></th>
                                                    {{-- <th scope="row" id="file10_statut"><span class="bg-success p-2 rounded text-white"><i class="icon-copy fa fa-thumbs-up" aria-hidden="true"></i> Chargé</span></th> --}}
                                                    <th scope="row" id="file10_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">11</th>
                                                    <th scope="row">La copie legalisee de l'extrait de mariage de chaque veuve</th>
                                                    <input type="hidden" name="titles[]" value="La copie legalisee de l'extrait de mariage de chaque veuve">
                                                    <th scope="row"><input type="file" name="files[]" id="file11" id="file11" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file11','file11_statut')"></th>
                                                    <th scope="row" id="file11_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">12</th>
                                                    <th scope="row">La copie legalisee de l'extrait de naissance de chaque enfant de moins de 17 ans</th>
                                                    <input type="hidden" name="titles[]" value="La copie legalisee de l'extrait de naissance de chaque enfant de moins de 17 ans">
                                                    <th scope="row"><input type="file" name="files[]" id="file12" id="file12" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file12','file12_statut')"></th>
                                                    <th scope="row" id="file12_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">13</th>
                                                    <th scope="row">Certificat de vie collective individuelle des enfants de moins de 17 ans</th>
                                                    <input type="hidden" name="titles[]" value="Certificat de vie collective individuelle des enfants de moins de 17 ans">
                                                    <th scope="row"><input type="file" name="files[]" id="file13" id="file13" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file13','file13_statut')"></th>
                                                    <th scope="row" id="file13_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">14</th>
                                                    <th scope="row">Numero de telephone de l'assure</th>
                                                    <input type="hidden" name="titles[]" value="Numero de telephone de l'assure">
                                                    <th scope="row"><input type="file" name="files[]" id="file14" id="file14" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file14','file14_statut')"></th>
                                                    <th scope="row" id="file14_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                                </tr>
                                            @elseif ($type_pension == "reversion")
                                            <tr>
                                                <th scope="row">1</th>
                                                <th scope="row">Demande adressé au DG</th>
                                                <th scope="row"><input type="file" id="file1" name="file1" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg"   onchange="myFunction('file1','file1_statut')" id="file1" /></th>
                                                <th scope="row" id="file1_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <th scope="row">Le carnet d'assuré ou le dernier Bulletin</th>
                                                <th scope="row"><input type="file"  id="file2" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file2','file2_statut')"></th>
                                                <th scope="row" id="file2_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <th scope="row">Acte ou le Certificat de décès</th>
                                                <th scope="row"><input type="file"  id="file3" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file3','file3_statut')"></th>
                                                <th scope="row" id="file3_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <th scope="row">Le procès verbal de conseil de famille</th>
                                                <th scope="row"><input type="file"  id="file4" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file4','file4_statut')"></th>
                                                <th scope="row" id="file4_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <th scope="row">Le certificat de résidence de chaque veuve</th>
                                                <th scope="row"><input type="file"  id="file5" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file5','file5_statut')"></th>
                                                <th scope="row" id="file5_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <th scope="row">Copie légalisée de l'extrait de mariage de chaque veuve</th>
                                                <th scope="row"><input type="file"  id="file6" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file6','file6_statut')"></th>
                                                <th scope="row" id="file6_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">7</th>
                                                <th scope="row">Quatre(4) photos d'identités de chaque veuve</th>
                                                <th scope="row"><input type="file"  id="file7" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file7','file7_statut')"></th>
                                                <th scope="row" id="file7_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">8</th>
                                                <th scope="row">La copie recto-verso de la carte d'identité de chaque veuve</th>
                                                <th scope="row"><input type="file"  id="file8" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file8','file8_statut')"></th>
                                                <th scope="row" id="file8_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">9</th>
                                                <th scope="row">La copie légalisée de l'extrait de naissance de chaque enfant de moins de 17 ans</th>
                                                <th scope="row"><input type="file"  id="file9" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file9','file9_statut')"></th>
                                                <th scope="row" id="file9_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
                                            <tr>
                                                <th scope="row">10</th>
                                                <th scope="row">Certificat de vie collective individuelle des enfants de moins de 17 ans</th>
                                                <th scope="row"><input type="file"  id="file10" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file10','file10_statut')"></th>
                                                {{-- <th scope="row" id="file10_statut"><span class="bg-success p-2 rounded text-white"><i class="icon-copy fa fa-thumbs-up" aria-hidden="true"></i> Chargé</span></th> --}}
                                                <th scope="row" id="file10_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>

                                            <tr>
                                                <th scope="row">11</th>
                                                <th scope="row">Numero de telephone de l'assure</th>
                                                <th scope="row"><input type="file" id="file14" id="file14" accept="application/pdf" class="form-control-file form-control height-auto" data-toggle="modal" data-target="#bd-example-modal-lg" onchange="myFunction('file14','file14_statut')"></th>
                                                <th scope="row" id="file14_statut"><span class="badge badge-danger"><i class="icon-copy fa fa-warning" aria-hidden="true"></i> Non Chargé</span></th>
                                            </tr>
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
                                        <div class="card-header" id="card-header-recap-conj1" >
                                            <div class="btn btn-block" data-toggle="collapse"  data-target="#faq2">
                                                <strong>INFOS CONJOINTS ET ENFANTS</strong>
                                            </div>
                                        </div>
                                        <div class="faq-wrap">
                                            @foreach ($data['employeDetails'] as $key => $value)
                                            <div id="accordion">
                                                <div class="card">
                                                    <div class="card-header" id="card-header-recap-conj2">
                                                        <div class="btn btn-block" data-toggle="collapse" data-target="faq{{ $key }}" >
                                                        Conjoint(e) {{ $key+1}} - {{ $value['conjoint_name'] }} {{ $value['conjoint_prenom'] }}
                                                        </div>
                                                    </div>
                                                    <div id="faq{{ $key }}" class="collapse show" data-parent="accordion">
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
                                                                    @foreach ($value['enfants'] as $key => $enfant)
                                                                        @if ($enfant == null)
                                                                            <div class="alert alert-secondary" role="alert">
                                                                                Pas d'enfants
                                                                            </div>
                                                                        @else
                                                                            <tr>
                                                                                <th scope="row">{{ $key + 1 }}</th>
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

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                        <input type="text" name="code_employe" value="{{ $data['employe'][0]->code_employe }}" id="">
<input type="hidden" name="date_jour" value="{{ $data['employe'][0]->date_jour }}" id="">
<input type="hidden" name="date_embauche" value="{{ $data['employe'][0]->date_embauche }}" id="">
<input type="hidden" name="date_etabl_cin" value="{{ $data['employe'][0]->date_etabl_cin }}" id="">
<input type="hidden" name="date_immatriculation" value="{{ $data['employe'][0]->date_immatriculation }}" id="">
<input type="hidden" name="datemodification" value="{{ $data['employe'][0]->datemodification }}" id="">
<input type="hidden" name="employeur_id" value="{{ $data['employe'][0]->employeur_id }}" id="">
<input type="hidden" name="lieu_etab_cin" value="{{ $data['employe'][0]->lieu_etab_cin }}" id="">
<input type="hidden" name="nationalite" value="{{ $data['employe'][0]->nationalite }}" id="">
<input type="hidden" name="date_created" value="{{ $data['employe'][0]->date_created }}" id="">
<input type="hidden" name="no_cin" value="{{ $data['employe'][0]->no_cin }}" id="">
<input type="hidden" name="nom_mere" value="{{ $data['employe'][0]->nom_mere }}" id="">
<input type="hidden" name="nom_pere" value="{{ $data['employe'][0]->nom_pere }}" id="">
<input type="hidden" name="pays_id" value="{{ $data['employe'][0]->pays_id }}" id="">
<input type="hidden" name="prefecture" value="{{ $data['employe'][0]->prefecture }}" id="">
<input type="hidden" name="prenom_mere" value="{{ $data['employe'][0]->prenom_mere }}" id="">
<input type="hidden" name="prenom_pere" value="{{ $data['employe'][0]->prenom_pere }}" id="">
<input type="hidden" name="no_employeur" value="{{ $data['employe'][0]->no_employeur }}" id="">
<input type="hidden" name="profession" value="{{ $data['employe'][0]->profession }}" id="">
<input type="hidden" name="sexe" value="{{ $data['employe'][0]->sexe }}" id="">
<input type="hidden" name="situationpro" value="{{ $data['employe'][0]->situationpro }}" id="">
<input type="hidden" name="statut" value="{{ $data['employe'][0]->statut }}" id="">
<input type="hidden" name="statut_employe_id" value="{{ $data['employe'][0]->statut_employe_id }}" id="">
<input type="hidden" name="adresse" value="{{ $data['employe'][0]->adresse }}" id="">
<input type="hidden" name="anciencode_employeur" value="{{ $data['employe'][0]->anciencode_employeur }}" id="">
<input type="hidden" name="ancien_num_employe" value="{{ $data['employe'][0]->ancien_num_employe }}" id="">
<input type="hidden" name="datesortie" value="{{ $data['employe'][0]->datesortie }}" id="">
<input type="hidden" name="tag_rattrapage" value="{{ $data['employe'][0]->tag_rattrapage }}" id="">
<input type="hidden" name="user_id" value="{{ $data['employe'][0]->user_id }}" id="">
<input type="hidden" name="categorie_id" value="{{ $data['employe'][0]->categorie_id }}" id="">
{{-- <input type="hidden" name="tag_retraite" value="{{ $data['employe'][0]->tag_retraite }}" id=""> --}}
<input type="hidden" name="tag_deces" value="{{ $data['employe'][0]->tag_deces }}" id="">
<input type="hidden" name="tag_invalidite" value="{{ $data['employe'][0]->tag_invalidite }}" id="">
<input type="hidden" name="tag_compte_indiv" value="{{ $data['employe'][0]->tag_compte_indiv }}" id="">
<input type="hidden" name="tag_statut" value="{{ $data['employe'][0]->tag_statut }}" id="">
<input type="hidden" name="tag_famille" value="{{ $data['employe'][0]->tag_famille }}" id="">
<input type="hidden" name="prefecture_id" value="{{ $data['employe'][0]->prefecture_id }}" id="">
<input type="hidden" name="code_prefecture" value="{{ $data['employe'][0]->code_prefecture }}" id="">
<input type="hidden" name="pref_id" value="{{ $data['employe'][0]->pref_id }}" id="">
<input type="hidden" name="agen_id" value="{{ $data['employe'][0]->agen_id }}" id="">
<input type="hidden" name="agencecode_id" value="{{ $data['employe'][0]->agencecode_id }}" id="">
<input type="hidden" name="tag_allocfam" value="{{ $data['employe'][0]->tag_allocfam }}" id="">
<input type="hidden" name="tag_famille_pf" value="{{ $data['employe'][0]->tag_famille_pf }}" id="">
<input type="hidden" name="tag_allocprepost" value="{{ $data['employe'][0]->tag_allocprepost }}" id="">
<input type="hidden" name="tag_ijcongemat" value="{{ $data['employe'][0]->tag_ijcongemat }}" id="">
<input type="hidden" name="tag_alloc_chomage" value="{{ $data['employe'][0]->tag_alloc_chomage }}" id="">
<input type="hidden" name="tag_allocataire_pf" value="{{ $data['employe'][0]->tag_allocataire_pf }}" id="">
<input type="hidden" name="tag_retraite" value="{{ $data['employe'][0]->tag_retraite }}" id="">
<input type="hidden" name="age_reel_deces" value="{{ $data['employe'][0]->age_reel_deces }}" id="">
<input type="hidden" name="assignation_id" value="{{ $data['employe'][0]->assignation_id }}" id="">
<input type="hidden" name="date_deces" value="{{ $data['employe'][0]->date_deces }}" id="">
<input type="hidden" name="no_acte_deces" value="{{ $data['employe'][0]->no_acte_deces }}" id="">
<input type="hidden" name="tag_famille_rp" value="{{ $data['employe'][0]->tag_famille_rp }}" id="">
<input type="hidden" name="tag_rente_deces" value="{{ $data['employe'][0]->tag_rente_deces }}" id="">
<input type="hidden" name="tag_suspension" value="{{ $data['employe'][0]->tag_suspension }}" id="">
<input type="hidden" name="matricule" value="{{ $data['employe'][0]->matricule }}" id="">

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
            reader.onload = function (e) {
              document.querySelector("#img").setAttribute("src",e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
          }
        }
    </script>

    <script>
        function loadDeposant(){
            if (document.getElementById('sameGuy').checked){
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

        function recapDeposant(){
            var nom_deposant=document.getElementById("nom_deposant").value  
            var prenom_deposant=document.getElementById("prenom_deposant").value 
            var telephone_deposant=document.getElementById("telephone_deposant").value 
            var adresse_deposant=document.getElementById("adresse_deposant").value 
            var email_deposant=document.getElementById("email_deposant").value 
            alert(nom_deposant);
            document.getElementById("nom_dep").value = nom_deposant;
            document.getElementById("prenom_dep").value = prenom_deposant;
            document.getElementById("telephone_dep").value = telephone_deposant;
            document.getElementById("adresse_dep").value = adresse_deposant;
        }
    </script>

    <script>
        function myFunction(file,status){
            // $.ajaxSetup({
            //     headers: ({
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     })
            // })
            // var files = $(file).val();
            // var original_file = document.getElementById('file1').files[0];
            // var name = original_file.name;
            // var extension_file = name.split('.').pop().toLowerCase();
            // var form_data = new FormData();
            // form_data.append('file',original_file);
            if (file != '') {
                // var fichier = document.getElementById(file);

                // if (fichier.files && fichier.files[0]) {

                //     var reader = new FileReader();
                //     reader.onload = function(e){
                //         $('#file_preview').attr('src',e.target.result).width(300).height(400);

                //     };
                //     reader.readAsDataURL(fichier.files[0]);
                // }

                document.getElementById(status).innerHTML='<span class="bg-success p-2 rounded text-white"><i class="icon-copy fa fa-thumbs-up" aria-hidden="true"></i> Chargé</span>';
            }
        }
    </script>

@endif


@endsection
