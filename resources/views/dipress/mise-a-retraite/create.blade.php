@extends('welcome')

@section('body')

<div class="page-header shadow-lg">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>ETUDE DE DOSSIER</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Etude de dossier</a></li>
                    <li class="breadcrumb-item"><a href="#">Mise en Retraite</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mise a la retraite d'un employe</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row py-2 shadow-lg">
    <div class="col-md-6">
       <div>
            <span class="text-left font-weight-bold font-14">NoAssure Social</span>
            <span class="float-right font-weight-bold font-12">{{ $emp->no_ima_employee }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Prenom</span>
            <span class="float-right font-12">{{ $emp->prenom_employee }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Sexe</span>
            <span class="float-right font-12">{{ $emp->sexe }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Prefecture</span>
            <span class="float-right font-12">{{ DB::table('prefecture')->where('code',$emp->prefecture_employee)->value('libelle') }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Date de naissance</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_naissance_employee)->format('d-m-Y') }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Age actuel</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_naissance_employee)->diff(\Carbon\Carbon::now())->format('%y ans et %m mois'); }} </span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Nationalite</span>
            <span class="float-right font-12">{{ $emp->nationalite }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Profession</span>
            <span class="float-right font-12">{{ $emp->profession }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Date de premiere embauche</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_embauche)->format('d-m-Y') }}</span>
       </div>
       {{-- <div>
            <span class="text-left font-weight-bold font-14">Annuite de service</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_embauche)->diffInMonths(\Carbon\Carbon::now()) }} mois</span>
       </div> --}}
       {{-- <div>
            <span class="text-left font-weight-bold font-14">(Depuis la date de premiere embauche jusqu'a ce jour)</span>
            <span class="float-right font-12"> {{  \Carbon\Carbon::parse($emp->date_embauche)->diff(\Carbon\Carbon::now())->format('%y ans et %m mois'); }}</span>
       </div> --}}
       <div>
            <span class="text-left font-weight-bold font-14">Employeur(s)</span>
            <span class="float-right font-12">{{ $emp->employer->raison_sociale }}</span>
       </div>
    </div>

    <div class="col-md-6">
        <div>
            <span class="text-left font-weight-bold font-14">Nom</span>
            <span class="float-right font-12">{{ $emp->nom_employee }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Situation matrimoniale</span>
            <span class="float-right font-12">{{ $emp->situation_matri_employee }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Agence</span>
            <span class="float-right font-12">{{ $emp->agence }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Lieu de naissance</span>
            <span class="float-right font-12">{{ $emp->lieu_naissance_employee }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Pays</span>
            <span class="float-right font-12">{{ $emp->pays_id }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">NoCIN</span>
            <span class="float-right font-12">{{ $emp->no_cin }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Date immatriculation en cotisation</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_immatriculation)->format('d-m-Y') }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Date acception dossier</span>
            <span class="float-right font-12">{{ $emp->created_at->format('d-m-Y') }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">NoDossier depose</span>
            <span class="float-right font-12"></span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Date de premier depot</span>
            <span class="float-right font-12">{{ $emp->created_at->format('d-m-Y') }}</span>
       </div>
    </div>
</div>

<form action=" {{ route('miseRetaite.store') }}" method="post" id="retraite_form">

    @csrf

    <div class="row mt-3 py-2 shadow-lg">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h6>NOMBRE DE MOIS D'ASURANCE</h6>
                    <span class="text-danger">120 mois</span>

                </div>
                <div class="col-md-2">
                    <h6>PERIODE DEBUT</h6>
                    <span id="debut_text" class="text-danger"></span>
                    <input type="hidden" id="debut_text_1" name="debut_acti">
                </div>
                <div class="col-md-2">
                    <h6>PERIODE FIN</h6>
                    <span id="fin_text" class="text-danger"></span>
                    <input type="hidden" id="fin_text_1" name="fin_acti">
                </div>
                <div class="col-md-4">
                    <h6>PRIODES CORRECTEMENT RENSEIGNEES</h6>
                    <span class="text-danger">120/120</span>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">No CIN <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" id="no_ci" name="no_ci" type="text" value="{{ $emp->no_cin }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">NoBiometrie</label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" id="no_bio" name="no_bio" type="text" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Assignation <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <select class="custom-select col-12" id="assign_pref_id" name="assign_pref_id" required>
                                <option value="">-- Selectionner --</option>
                                @foreach ($prefectures as $pref)
                                <option value="{{ $pref->code }}">{{ $pref->code }}-{{ $pref->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Date premiere embauche <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" id="first_job_date" type="date" name="first_job_date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Date cessation activite <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" type="date" name="end_job_date" id="cessation_date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Annuite <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" type="text" name="annuite" id="annuite" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Date Immatriculation pension <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" type="date" id="date_imma" name="date_imma" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Derniere Adresse <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" type="text" id="last_location" name="last_location" value="{{ $emp->adresse_employee }}" required>
                            <input type="hidden" name="emp_id" value="{{ $emp->id }}">
                            <input type="hidden" name="pension_type" value="{{ $emp->type_pension }}">
                            <input type="hidden" name="sexe" value="{{ $emp->sexe }}">
                            <input type="hidden" name="age" value="{{ \Carbon\Carbon::parse($emp->date_naissance_employee)->diff(\Carbon\Carbon::now())->format('%y'); }} ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Prefecture de naissance <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <select class="custom-select col-12" id="prefecture_id" name="prefecture_id" required>
                                <option value="">-- Selectionner --</option>
                                <option selected value="{{ $emp->prefecture_employee }}">{{ DB::table('prefecture')->where('code',$emp->prefecture_employee)->value('libelle') }}</option>
                                @foreach ($prefectures as $pref)
                                <option value="{{ $pref->code }}">{{ $pref->code }}-{{ $pref->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Categorie socio-professionnelle <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <select class="custom-select col-12" id="socio_profess" name="socio_profess" required>
                                <option value="">-- Selectionner --</option>
                                <option value="01-EMPLOYE">01-EMPLOYE</option>
                                <option value="02-CADRE MOYEN">02-CADRE MOYEN</option>
                                <option value="03-CADRE SUPERIEUR">03-CADRE SUPERIEUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Profession <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" type="text" id="profession" name="profession" value="{{ $emp->profession }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Email</label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" type="email" id="email" name="email" value="{{ $emp->email_employee }}" placeholder="adresse email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-6 col-form-label">Telephone <span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-6">
                            <input class="form-control" type="text" id="tel" name="tel" value="{{ $emp->tel_employee }}" required>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-lg-end">
        <div class="col-md-4">
            <button type="button" id="conf_modal" class="btn btn-success my-3">Confirmation de la mise a la retraite</button>
            {{-- <a href="#" id="conf_modal" class="btn btn-success my-3" data-toggle="modal" data-target="#confirmation-modal" type="button">
                Confirmation de la mise a la retraite
            </a> --}}
            <div class="modal fade" id="patapata" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-success text-white">
                        <div class="modal-body text-center font-18">
                            <h4 class=" text-white padding-top-30 mb-30 weight-500">Confirmez-vous la mise à la retraite de cet employer ?</h4>
                            <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary btn-light border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    NON
                                </div>
                                <div class="col-6">
                                    <button type="button" id="send_retraite_form" class="btn btn-primary btn-light border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-check"></i></button>
                                    OUI
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="potopoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content bg-danger text-white">
                        <div class="modal-body text-center">
                            <h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Alert</h3>
                            <p class="text-uppercase">
                                veuillez remplir tous les champs obligatoires.
                            </p>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="potopoto_1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content bg-danger text-white">
                        <div class="modal-body text-center">
                            <h3 class="text-white mb-15"><i class="fa fa-exclamation-triangle"></i> Alert</h3>
                            <p class="text-uppercase">
                                l'annuiter ne doit pas etre superieure a 30 ans
                            </p>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</form>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>

    $(document).ready(function () {
        $('#cessation_date').prop('disabled',true);

        $('#send_retraite_form').on('click', function() {
            $("#retraite_form").submit();
        });

        $('#conf_modal').on('click', function() {
            var no_ci =  $("#no_ci").val();
            // var no_bio =  $("#no_bio").val();
            var assign_pref_id =  $("#assign_pref_id").val();
            var first_job_date =  $("#first_job_date").val();
            var cessation_date =  $("#cessation_date").val();
            var annuite =  $("#annuite").val();
            var date_imma =  $("#date_imma").val();
            var last_location =  $("#last_location").val();
            var prefecture_id =  $("#prefecture_id").val();
            var socio_profess =  $("#socio_profess").val();
            var profession =  $("#profession").val();
            // var email =  $("#email").val();
            var tel =  $("#tel").val();

            if(annuite !="" && annuite > 30){
                $('#potopoto_1').modal('show');
                $('#cessation_date').val('');
            }

            if(no_ci=="" || assign_pref_id=="" || first_job_date=="" || cessation_date==""
                || annuite=="" || date_imma=="" || last_location=="" || prefecture_id=="" || socio_profess==""
                || tel=="" || profession==""
            ){
                $('#potopoto').modal('show');
            } else {
                $('#patapata').modal('show');
            }

        });
    });

    $("#first_job_date").blur(function (){
        if(!Date.parse($(this).val())){
            $('#cessation_date').prop('disabled',true);
            $('#cessation_date').val("");
        }else{
            $('#cessation_date').prop('disabled',false);
        }
    });


</script>
<script>

    $('#cessation_date').on('change', function () {

        var selectedDate = new Date($(this).val());
        $("#fin_text").html(selectedDate.toISOString().split('T')[0]);
        $("#fin_text_1").html(selectedDate.toISOString().split('T')[0]);

        selectedDate.setFullYear(selectedDate.getFullYear() - 10);
        // console.log(selectedDate);
        $('#debut_text').html(selectedDate.toISOString().split('T')[0]);
        $('#debut_text_1').html(selectedDate.toISOString().split('T')[0]);


        var debut_date = new Date($(this).val());
        var fin_date = new Date($('#first_job_date').val());
        var years = fin_date.getFullYear() - debut_date.getFullYear();
        if (fin_date.getMonth() < debut_date.getMonth() || (fin_date.getMonth() == debut_date.getMonth() && fin_date.getDate() < debut_date.getDate())) {
            years--;
        }
        var ann = years.toString().replace(/[^0-9]/g, '');

        if(ann > 30){
            $('#potopoto_1').modal('show');
            $('#cessation_date').val('');
        } else {
            $('#annuite').val(ann);
        }
        // console.log(ann);


    });


</script>


@endsection
