@extends('welcome')

@section('body')

    <div class="page-header shadow-lg">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="title">
                    <h4>RETRAITE</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('prestation.index') }}">retraite</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page"> ECHEANCE - {{ $echeance->mois }} {{ $echeance->annee }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-3 col-sm-12 text-right">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-paye-add">Nouveau <i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-warning">Importer <i class="fa fa-upload" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="modal-paye-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="height:800px;">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-white text-center" id="myLargeModalLabel">Ajout individuel d'un(e) retraité(e)</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Num retraite</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Nom</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Prenoms</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Date de naiss</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control date-picker" placeholder="Select Date" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Date de jouiss</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control date-picker" placeholder="Select Date" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Échéance prem vrmt</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control date-picker" placeholder="Select Date" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Code bank</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Code agence</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Num compte</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Clé RIB</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Société origine</label>
                                    <div class="col-sm-12 col-md-8">
                                        <select class="custom-select col-12">
                                            <option selected="">--Aucune selection--</option>
                                            <option value="1">One</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Téléphone</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Assignation</label>
                                    <div class="col-sm-12 col-md-8">
                                        <select class="custom-select col-12">
                                            <option selected="">--Aucune selection--</option>
                                            <option value="1">One</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Assignation 1</label>
                                    <div class="col-sm-12 col-md-8">
                                        <select class="custom-select col-12">
                                            <option selected="">--Aucune selection--</option>
                                            <option value="1">One</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Montant trim</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">AF</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Montant comp</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Montant comp plus</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Montant mens reval</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Montant à payer</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="col-md-6 col-sm-12">
                                    {{-- <label class="weight-600">NC</label> --}}
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                        <label class="custom-control-label" for="customCheck1-1">NC</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Mens du</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Mont arriéré</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Mont tot à payer</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Agence</label>
                                    <div class="col-sm-12 col-md-8">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Type</label>
                                    <div class="col-sm-12 col-md-4 custom-control custom-radio mt-2">
                                        <input type="radio" id="customRadio44" name="customRadio1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio44">01-</label>
                                    </div>
                                    <div class="col-sm-12 col-md-4 custom-control custom-control custom-radio mt-2">
                                        <input type="radio" id="customRadio55" name="customRadio1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio55">PI-</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-4 col-form-label">Titre</label>
                                    <div class="col-sm-12 col-md-4 custom-control custom-radio mt-2">
                                        <input type="radio" id="customRadio444" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio444">Mr</label>
                                    </div>
                                    <div class="col-sm-12 col-md-4 custom-control custom-control custom-radio mt-2">
                                        <input type="radio" id="customRadio555" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio555">Mme</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Observation</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                                <div class="form-group row">
                                    {{-- <div class="col-sm-12 col-md-6 custom-control custom-radio mt-2">
                                        <button type="button" class="close btn btn-danger" data-dismiss="modal">Annuler</button>
                                    </div> --}}
                                    <div class="col-sm-12 col-md-6 custom-control custom-control custom-radio mt-2 text-end">
                                        <button type="submit" class="btn btn-success">Valider <i class="fa fa-check" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </form>
                </div>

            </div>
        </div>
    </div>


    <form action="" method="get" class="">
        @csrf
        <div class="row justify-content-center shadow-lg p-2">
            <div class="col-md-2">
                <label class="weight-600">Type</label>

                <div class="custom-control custom-radio ">
                    <input checked type="radio" id="customRadio4type" value="01" name="radio_type" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio4type">01-</label>
                </div>
                <div class="custom-control custom-radio ">
                    <input type="radio" id="customRadio5type" value="pi" name="radio_type" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio5type">PI</label>
                </div>
            </div>
            <div class="col-md-2">
                <label class="weight-600">État</label>

                <div class="custom-control custom-radio ">
                    <input checked type="radio" id="customRadio4" value="all" name="radio_etat" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio4">Tous</label>
                </div>
                <div class="custom-control custom-radio ">
                    <input type="radio" id="customRadio5" value="old" name="radio_etat" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio5">Ancienne C</label>
                </div>
                <div class="custom-control custom-radio ">
                    <input type="radio" id="customRadio6" value="new" name="radio_etat" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio6">Nouvelle C</label>
                </div>
            </div>
            <div class="col-md-3">
                <label class="col-sm-12 weight-600 col-md-12 col-form-label">Assignations</label>
                <div class="col-sm-12 col-md-10">
                    <select id="ass_1" name="assignation" required class="form-control form-control-sm">
                        <option selected value="0">--Aucune selection--</option>
                        @foreach ($assignations as $ass)
                        <option value="{{ $ass->assignation }}">{{ $ass->assignation }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label class="col-sm-12 weight-600 col-md-12 col-form-label">Assignations 1</label>
                <div class="col-sm-12 col-md-10">
                    <select id="ass_2" name="assignation1" class="form-control form-control-sm">
                        <option selected value="0">--Aucune selection--</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success" style="margin-top: 36px;">Appliquer le filtre <i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>


    @if ($echeance->rertaites != null)
    <div class="pb-20 mb-3">
        <div class="pd-20">
            <h4 class="text-blue h4">Liste des pensionnaires</h4>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="bg-success">
                <tr>
                {{-- <th class="table-plus text-white">#</th> --}}
                <th class="text-white font-12">Num Retraite</th>
                <th class="text-white font-12">Type</th>
                <th class="text-white font-12">Prénoms</th>
                <th class="text-white font-12">Nom</th>
                <th class="text-white font-12">Date Naiss</th>
                <th class="text-white font-12">Date Jouiss</th>
                <th class="text-white font-12">Titre</th>
                <th class="text-white font-12">Mont Trim</th>
                <th class="text-white font-12">Mont Av</th>
                <th class="text-white font-12">Mont Comp</th>
                <th class="text-white font-12">Assignation</th>
                <th class="text-white font-12">Assignation 1</th>
                <th class="text-white font-12">Société Orig</th>
                <th class="text-white font-12">Montant Paye</th>
                <th class="datatable-nosort text-white font-12">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($echeances->rertaites as $ret)
                <tr>
                    {{-- <td>{{ $loop->index+1 }}</td> --}}
                    <td class="font-12">{{ $ret->num_retraite }}</td>
                    <td class="font-12">{{ $ret->type }}</td>
                    <td class="font-12">{{ $ret->prenoms }}</td>
                    <td class="font-12">{{ $ret->nom }}</td>
                    <td class="font-12 text-nowrap">{{ \Carbon\Carbon::parse($ret->date_de_naiss)->format('d-m-Y') }}</td>
                    <td class="font-12 text-nowrap">{{ \AppHelper::getDateFormat($ret->date_de_jouiss) }}</td>
                    <td class="font-12">{{ $ret->titre }}</td>
                    <td class="font-12 text-right text-nowrap">{{ \AppHelper::getMoneyFormat($ret->montant_trim) }} GNF</td>
                    <td class="font-12 text-right text-nowrap">{{ \AppHelper::getMoneyFormat($ret->montant_avance) }} GNF</td>
                    <td class="font-12 text-right text-nowrap">{{ \AppHelper::getMoneyFormat($ret->montant_comp) }} GNF</td>
                    <td class="font-12">{{ $ret->assignation }}</td>
                    <td class="font-12">{{ $ret->assignation1 }}</td>
                    <td class="font-12">{{ $ret->aociéte_orig }}</td>
                    <td class="font-12 text-right text-nowrap">{{ \AppHelper::getMoneyFormat($ret->montant_a_paye) }} GNF</td>
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-paye-moi-test{{ $ret->id }}" type="button" href="#"><i class="dw dw-eye"></i> Détails</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                            </div>
                            <div class="modal fade bs-example-modal-lg" id="modal-paye-moi-test{{ $ret->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content" style="height:500px;">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">Echeance</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <h3 class="text-center text-white bg-success">Détails sur l'echeance date ici</h3>
                                            <div class="row p-5">
                                                <div class="col-md-6">
                                                    <div>
                                                        <span class="text-left font-weight-bold font-18">Num retraite</span>
                                                        <span class="float-right font-16">{{ $ret->num_retraite }}</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Prenoms</span>
                                                        <span class="float-right font-16">{{ $ret->prenoms }}</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Nom</span>
                                                        <span class="float-right font-16">{{ $ret->nom }}</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Titre</span>
                                                        <span class="float-right font-16">{{ $ret->titre }}</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Date de Naissance</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getDateFormat($ret->date_de_naiss) }}</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Date de Jouissance</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getDateFormat($ret->date_de_jouiss) }}</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Montant mens reval</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getMoneyFormat($ret->montant_mens_reval) }} GNF</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Montant avance</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getMoneyFormat($ret->montant_avance) }} GNF</span>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <span class="text-left font-weight-bold font-18">Trim du</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getMoneyFormat($ret->trim_du) }} GNF</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Pour</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getMoneyFormat($ret->pour) }} GNF</span>
                                                </div>


                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Montant arriéré</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getMoneyFormat($ret->montant_arriere) }} GNF</span>
                                                </div>
                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Montant à payer</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getMoneyFormat($ret->montant_a_paye) }} GNF</span>
                                                </div>

                                                <div>
                                                        <span class="text-left font-weight-bold font-18">Mappr</span>
                                                        <span class="float-right font-16">{{ \AppHelper::getMoneyFormat($ret->mappr) }} GNF</span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
    </div>
    @endif





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap4.min.css">

<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap4.min.js"></script>


<script>
    // $(document).ready(function() {
    //     new DataTable('#example');

    // });



        // $.ajax({
        //     url: '/paye/retraite/index/getAll',
        //     type: 'GET',
        //     dataType: 'json',
        //     success: function(data) {
        //         console.log('baby', data);

        //         var table = $('#example').DataTable({
        //             searching: true,
        //             paging: true,
        //             pageLength: 10,
        //         });


        //         data.forEach(function(item) {

        //             table.row.add([
        //                 item.num_retraite ,
        //                 item.type,
        //                 item.prenoms,
        //                 item.nom,
        //                 item.date_de_naiss,
        //                 '',
        //                 item.titre,
        //                 '',
        //                 '',
        //                 '',
        //                 item.assignation,
        //                 item.assignation1,
        //                 item.aociéte_orig,
        //                 '',
        //                 '',
        //             ]).draw();
        //         });
        //     },
        //     error: function(error) {

        //         console.log(error);
        //     }
        // });



</script>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

{{-- <script>
    $(document).ready(function() {
        $('input[type=radio][name=radio_etat]').change(function() {
            var selectedType = $(this).val();
            $.ajax({
                url: '/paye/retraite/index/filter-etat',
                data: { type: selectedType },
                success: function(data) {
                    var tbody = $('#paye-body1');
                    tbody.empty(); // Clear the table body
                     console.log('Valllueee', data);
                     $.each(data, function(index, item) {
                        // console.log('val', item.assignation1);
                        tbody.append(
                            '<tr><td class="font-12">' + item.num_retraite +
                            '</td><td class="font-12">' + item.type +
                            '</td><td class="font-12">' + item.prenoms +
                            '</td><td class="font-12">' + item.nom +
                            '</td><td class="font-12">' + '' +
                            '</td><td class="font-12">' + '' +
                            '</td><td class="font-12">' + item.titre +
                            '</td><td class="font-12">' + '' +
                            '</td><td class="font-12">' + '' +
                            '</td><td class="font-12">' + '' +
                            '</td><td class="font-12">' + item.assignation +
                            '</td><td class="font-12">' + item.assignation1 +
                            '</td><td class="font-12">' + item.aociéte_orig +
                            '</td><td class="font-12">' + '' +
                            '</td><td class="font-12">' + '' +
                            '</td></tr>'
                        );
                     });
                }
            });
        });
    });
</script> --}}


<script>
    $(document).ready(function() {

        $('input[type=radio][name=radio_type]').change(function() {
            loadDatatable();
        });
        $('input[type=radio][name=radio_etat]').change(function() {
            loadDatatable();
        });

        $('#ass_1').change(function() {
            loadDatatable();
        });

        $('#ass_2').change(function() {
            loadDatatable();
        });

        //LOAD DATATABLE
        function loadDatatable() {
            var typeRadio = $('input[name="radio_type"]:checked').val();
            var etatRadio = $('input[name="radio_etat"]:checked').val();
            var assignation = $('#ass_1').val();
            var assignation1 = $('#ass_2').val();

            $.ajax({
                url: '/paye/retraite/filter',
                type: 'GET',
                dataType: 'json',
                data: {
                    typeRadio: typeRadio,
                    etatRadio: etatRadio,
                    assignation: assignation,
                    assignation1: assignation1,
                 },
                success: function(data) {
                   console.log('valueeee:', data);
                }
            });


        }

        //GET ASSIGNATION1
        $('#ass_1').change(function() {
            var selectedCategory = $(this).val();
            $.getJSON("{{ url('/paye/retraite/get-ass') }}", { option: selectedCategory }, function(data) {
                var subCategoryDropdown = $('#ass_2');
                subCategoryDropdown.empty();
                console.log('dattta ', data);
                // subCategoryDropdown.append("<option selected=''>--Aucune selection--</option>");
                $.each(data, function(index, element) {
                    subCategoryDropdown.append("<option value='" + element.assignation1 + "'>" + element.assignation1 + "</option>");
                });
            });
        });
    });
</script>

@endsection