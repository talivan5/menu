<template>
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-md-10">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">IP</th>
                            <th scope="col">Browser</th>
                            <th scope="col">Nombre User</th>
                            <th scope="col">O.S.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="bitacora in bitacoras" :key="bitacora.id">
                            <td>{{bitacora.ip}}</td>
                            <td>{{bitacora.browser}}</td>
                            <td>{{bitacora.nomuser}}</td>
                            <td>{{bitacora.os}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                bitacoras:[],
                ip:'',
                browser:'',
                nomuser:'',
                os:'',
                bitacora:{
                    ip:'',
                    browser:'',
                    nomuser:'',
                    os:'',
                }
            }
        },
        methods:{
            listar(){
                    let me =this;
                    axios.get('http://127.0.0.1:8000/api/bitacoras')
                    .then(function(response){
                        me.bitacoras=response.data.response;
                        me.crear();
                    })
                    .catch(function(error)
                    {
                        console.log(error);
                    })
                }
            },
            crear(){
                    let me = this;
                    axios.post('http://127.0.0.1:8000/api/bitacoras',
                    {
                        'ip':me.bitacora.ip,
                        'browser':me.bitacora.browser,
                        'nomuser':me.bitacora.nomuser,
                        'os':me.bitacora.os
                    })
                    .then(response=>{

                    }).catch(error => {
                        me.errors=error.response.data;
                    });
            },
        mounted() {
            this.listar();
        }
    }
</script>
