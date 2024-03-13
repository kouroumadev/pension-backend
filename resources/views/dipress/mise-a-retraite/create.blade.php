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
            <span class="float-right font-12">{{ $emp_full[0]->sexe }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Prefecture</span>
            <span class="float-right font-12">{{ $emp->prefecture_employee }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Date de naissance</span>
            <span class="float-right font-12">{{ $emp->date_naissance_employee->format('d.m.Y') }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Age actuel</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_naissance_employee)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days'); }} ans</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Nationalite</span>
            <span class="float-right font-12">{{ $emp_full[0]->nationalite }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Profession</span>
            <span class="float-right font-12">{{ $emp_full[0]->profession }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Date de premiere embauche</span>
            <span class="float-right font-12">{{ $emp_full[0]->date_embauche }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Annuite de service</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp_full[0]->date_embauche)->diffInMonths(\Carbon\Carbon::now()) }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">(Depuis la date de premiere embauche jusqu'a ce jour)</span>
            <span class="float-right font-12"> {{ \Carbon\Carbon::parse($emp_full[0]->date_embauche)->diffInMonths(\Carbon\Carbon::now()) }} ans</span>
       </div>
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
            <span class="float-right font-12">{{ $emp_full[0]->agence }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Lieu de naissance</span>
            <span class="float-right font-12">{{ $emp->lieu_naissance_employee }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Pays</span>
            <span class="float-right font-12">{{ $emp_full[0]->pays_id }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">NoCIN</span>
            <span class="float-right font-12">{{ $emp_full[0]->no_cin }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Date immatriculation en cotisation</span>
            <span class="float-right font-12">{{ $emp_full[0]->no_cin }}</span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">Date acception dossier</span>
            <span class="float-right font-12"></span>
        </div>
        <div>
            <span class="text-left font-weight-bold font-14">NoDossier depose</span>
            <span class="float-right font-12"></span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Date de premier depot</span>
            <span class="float-right font-12"></span>
       </div>
    </div>
</div>

<div class="row mt-3 py-2 shadow-lg">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <h6>NOMBRE DE MOIS D'ASURANCE</h6>
                <span>120 mois</span>
            </div>
            <div class="col-md-2">
                <h6>PERIODE DEBUT</h6>
                <span>120 mois</span>
            </div>
            <div class="col-md-2">
                <h6>PERIODE FIN</h6>
                <span>120 mois</span>
            </div>
            <div class="col-md-4">
                <h6>PRIODES CORRECTEMENT RENSEIGNEES</h6>
                <span>120 mois</span>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">No CIN</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text" value={{ $emp_full[0]->no_cin }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">NoBiometrie</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Assignation</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Date premiere embauche</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Date cessation activite</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Annuite</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Date Immatriculation pension</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Derniere Adresse</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Prefecture de naissance</label>
                    <div class="col-sm-8 col-md-6">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Categorie socio-professionnelle</label>
                    <div class="col-sm-8 col-md-6">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Profession</label>
                    <div class="col-sm-8 col-md-6">
                        <select class="custom-select col-12">
                            <option selected="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Email</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text" placeholder="Johnny Brown">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-6 col-form-label">Telephone</label>
                    <div class="col-sm-8 col-md-6">
                        <input class="form-control" type="text" placeholder="Johnny Brown">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
