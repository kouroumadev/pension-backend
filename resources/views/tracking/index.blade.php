@extends('welcome')

@section('body')

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
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_naissance_employee)->diff(\Carbon\Carbon::now())->format('%y ans, %m mois et %d jours'); }} </span>
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
            <span class="float-right font-12">{{ $emp->date_embauche }}</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">Annuite de service</span>
            <span class="float-right font-12">{{ \Carbon\Carbon::parse($emp->date_embauche)->diffInMonths(\Carbon\Carbon::now()) }} mois</span>
       </div>
       <div>
            <span class="text-left font-weight-bold font-14">(Depuis la date de premiere embauche jusqu'a ce jour)</span>
            <span class="float-right font-12"> {{ \Carbon\Carbon::parse($emp->date_embauche)->diffInYears(\Carbon\Carbon::now()) }} ans</span>
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
            <span class="float-right font-12">{{ $emp->date_immatriculation }}</span>
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

<div class="pb-20">
    <div class=" row pd-20">
        <div class="col-4">
            <span class="text-left font-weight-bold font-20">Parcours du dossier N°{{ $last_doc->doc->no_dossier }}</span>
        </div>
        <div class="col-4">
            <span class="text-left font-weight-bold font-20">Date de creation :{{ $last_doc->doc->created_at  }}</span>
        </div>
        <div class="col-4">
            <span class="text-left font-weight-bold font-20">Document :{{ $last_doc->doc->type_doc  }}</span>
        </div>
    </div>
    <table class="data-table table stripe hover nowrap dataTable no-footer dtr-inline" id="DataTables_Table_0"
        role="grid" aria-describedby="DataTables_Table_0_info">
        <thead class="bg-success">
            <tr>
                
                <th class="text-white">Rec</th> 
                <th class="text-white">Etat Precedent</th>
                <th class="text-white">Etat actuel</th>
                <th class="text-white">Obs</th>
                <th class="text-white">DeadLine</th>
                <th class="datatable-nosort text-white">Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($track as $key => $doc)
            @php
                $current_date = \Carbon\Carbon::parse(\Carbon\Carbon::now());
                $deadline = \App\Models\Deadline::where('dept_id',$doc->to_dept)->get();
                //dd($deadline[0]->name);
            @endphp
            
                <tr>

                    <td>{{  \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                    <td><span class="badge badge-warning">{{$doc->from->name}}</span></td>
                    <td><span class="badge badge-success">{{$doc->to->name}}</span></td>
                    @if ($current_date->diffInDays($doc->created_at) < (int)$deadline[0]->name)
                        <td >
                            {{$current_date->diffInDays($doc->created_at)}} <span class="badge " style=" text-align:center"></span> 
                        </td>
                    @elseif ($current_date->diffInDays($doc->created_at) == (int)$deadline[0]->name)
                        <td >
                            {{$current_date->diffInDays($doc->created_at)}} <span class="badge " style="background-color: rgb(52, 224, 95); text-align:center">à temps</span> 
                        </td>
                    @elseif ($current_date->diffInDays($doc->created_at) > (int)$deadline[0]->name)
                        <td >
                            {{$current_date->diffInDays($doc->created_at)}} <span class="badge " style="background-color: rgb(229, 67, 42); text-align:center"> En retard <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></span> 
                        </td>
                    @endif
                    <td>{{$deadline[0]->name}} Jour(s)</td>
                    <td> <a href="{{route('user.tracking',$doc->users->id)}}"> {{$doc->users->name}} </a> </td>

                   
                    
                    
                </tr>
            
                
            @endforeach
            
        </tbody>
    </table>
</div>

@endsection