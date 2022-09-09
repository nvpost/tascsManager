<div class="projects_tascs_field row">
    @foreach($tascs as $t)
                <div class="card-panel teal darken-1">

                <h6 class="white-text">{{$t->label}}</h6>
                    <p class="white-text status">
                        {{$t->statuses->status}}
                    </p>



                <div class="card_actions white-text">

                    @if($t->start_date || $t->finish_date)
                        <p class="white-text dates">
                            {{\Carbon\Carbon::parse($t->start_date)->format('d.m.Y')}}
                            -
                            {{\Carbon\Carbon::parse($t->finish_date)->format('d.m.Y')}}
                        </p>
                    @endif

                    <a class="waves-effect waves-teal btn-flat white-text modal-trigger" href="#tasc_modal_{{$t->id}}">Открыть</a>
                </div>
                </div>
        @include('content.project_tasc_modal')
    @endforeach
</div>

