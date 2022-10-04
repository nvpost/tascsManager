

<div class="chip">

    {{$row['get_users'][0]['email']}}
    @if($team['creator_id'] == Auth::user()->id)
        <i class="close material-icons" style="float:right;"
           onclick="removeUser('{{$row['get_users'][0]['id']}}', {{$team['id']}})"
        >close</i>
    @endif
</div>
