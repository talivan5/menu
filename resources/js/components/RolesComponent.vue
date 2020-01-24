<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Agregar Rol" v-model="role.name" aria-label="Agregar Rol" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" v-if="esNuevo" @click="crear()"><i class="fa fa-save" ></i>Agregar</button>
                        <button type="button" class="input-group-text" v-if="!esNuevo" @click="editar()"><i class="fa fa-save" ></i>Modificar</button>
                    </div>
                </div>
                <div v-for="role in roles" :key="role.id">
                    <ul class="list-group">
                        <li class="list-group-item">{{role.name}}
                        <div class="text-right">
                            <a type="button" class="btn btn-sm btn-danger pull-center" @click="confirmar(role)">
                                <i class="fa fa-trash-alt" aria-hidden="true"></i>
                            </a>
                            <a type="button" class="btn btn-sm btn-warning pull-center" @click="modificar(role)">
                                <i class="fa fa-user-edit" aria-hidden="true"></i>
                            </a>
                        </div>

                        </li>
                    </ul>
                </div>
                <div class="modal fade" id="confirmar">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Esta seguro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro de eliminar la role?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" @click="eliminar(role)"><i class="fa fa-check"></i> Aceptar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                roles:[],
                id:'',
                name:'',
                guard_name:'',
                role:{
                    name:'',
                    guard_rname:''
                },
                esNuevo:true
            }
        },
        methods:{
            listar(){
                let me =this;
                axios.get('http://127.0.0.1:8000/api/roles')
                .then(function(response){
                    me.roles=response.data.response;
                })
                .catch(function(error)
                {
                    console.log(error);
                })
            },
            eliminar(role){
                let me = this;
                axios.delete('http://127.0.0.1:8000/api/roles/' + role.id)
                .then(response=>{
                    $('#confirmar').modal('hide');
                    me.listar();
                    //toastr.success('Se elimino la materia correctamente...');
                })
                    .catch(function (error){
                    console.log(error);
                })
            },
            editar(){
                let me = this;
                axios.put('http://127.0.0.1:8000/api/roles/'+ me.id,
                {
                    'name':me.role.name
                })
                .then(response=>{
                    me.listar();
                    me.role.name='';
                    me.esNuevo=true;
                }).catch(error => {
                    me.errors=error.response.data;
                });
            },
            confirmar(role){
                this.role.id = role.id;
                $('#confirmar').modal({ backdrop: 'static', keyboard: false, show: true });
            },
            modificar(role){
                this.esNuevo=false;
                this.id=role.id;
                this.role.name=role.name;
            },
            crear(){
                let me = this;
                axios.post('http://127.0.0.1:8000/api/roles',
                {
                    'name':me.role.name,
                    'guard_name':me.role.guard_name
                })
                .then(response=>{
                    me.listar();
                    me.name='';
                }).catch(error => {
                    me.errors=error.response.data;
                });
            },
        },
        mounted(){
           this.listar();
       }
    }
</script>
