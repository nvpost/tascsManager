<div class="tasc_files col s12">
    <p><strong>Список файлов</strong></p>
    <ul class="collection">
        @foreach($files as $file)
            <li class="collection-item" data-file="{{$file->id}}">
                @php
                    $path_arr = explode('/', $file->link);
                    $file_name = $path_arr[count($path_arr)-1];
                @endphp
                <a href="{{url($file->link)}}">
                    {{$file_name}}
                </a>
                @if($disabled == "")
                    <span class="active_bar">
                        <span class="active_icons material-icons" onclick="del_file({{$file->id}})">
                        delete_outline
                        </span>
                    </span>
                @endif
            </li>
        @endforeach
    </ul>
</div>


<script>
    function del_file(file_id){
        console.log(file_id)
        fetch("{{route('user.del_tasc_file')}}", {
            method: "POST",
            headers:{
                "X-CSRF-Token":"{{csrf_token()}}",
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({file_id})
        }).then(res=>res.json())
            .then(data=>{
                console.log(data)
                document.querySelector("[data-file='"+file_id+"']").classList.add('animate__bounceOut')
            })
    }
    //.then(window.location.reload())
</script>
