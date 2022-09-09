

<div class="chip">


    {{$row['get_users'][0]['email']}}
    <i class="close material-icons" style="float:right;" onclick="removeUser('{{$row['get_users'][0]['id']}}', {{$team['id']}})">close</i>
</div>
