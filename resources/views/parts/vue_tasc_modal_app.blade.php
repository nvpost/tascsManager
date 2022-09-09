
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

<script>
    var stats = @json($stats)
</script>

<script>

    let matrix_app = new Vue({
        el: '.modal_tascs_app',
        data(){
            return {
                tasc_id: 0,
                tasc_label: 'Ghbvth',
                tasc_description: 'tasc_description',
                tasc_status: 'new',
                tasc_files: [],
                tasc_disabled: true
            }
        },
        methods:{
            getTascData(tasc_id){
                console.log(tasc_id)

                fetch("{{route('user.getTascData')}}", {
                    method: "POST",
                    headers:{
                        "X-CSRF-Token":"{{csrf_token()}}",
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({tasc_id})
                }).then(res=>res.json())
                    .then((data)=>{
                        console.log(data)
                        this.tasc_id = data.id
                        this.tasc_label = data.label
                        this.tasc_description = data.description
                        this.tasc_status = data.status
                        this.tasc_files = data.tasc_files
                        this.tasc_disabled = !data.canEdit

                        var modal = document.querySelector('#tasc_modal')
                        var instance = M.Modal.getInstance(modal)
                        instance.open()
                        instance.options.onCloseEnd = () => {
                            this.clearModalData()
                        }

                        setTimeout(()=>$('#status').formSelect(), 100)


                    })
            },
            clearModalData(){
                this.tasc_label = this.tasc_description = this.tasc_status = ''
                this.tasc_files = []
            },
            del_file(file_id){
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
        }
    })

</script>
