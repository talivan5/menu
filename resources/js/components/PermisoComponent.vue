<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <button type="button" class="btn btn-sm btn-primary pull-center" @click.prevent="nuevo()">
                    <i class="fa fa-plus"></i>Nuevo Permiso
                </button>
                <hr>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Permiso</th>
                            <th scope="col">Guardar</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="permiso in permisos" :key="permiso.id">
                            <th scope="row">{{permiso.id}}</th>
                            <td>{{permiso.name}}</td>
                            <td>{{permiso.guard_name}}</td>
                            <td>
                                <div class="text-center">
                                    <a href="#" class="btn btn-sm btn-danger pull-center" @click="confirmar(permiso)">
                                        <i class="fa fa-trash-alt" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success pull-center" @click="modificar(permiso)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="create">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Esta seguro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="permiso">Nombre:</label>
                            <input type="text" class="form-control" name="name" v-model="permiso.name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <a type="button" class="btn btn-sm btn-primary" @click.prevent="crear()"><i class="fa fa-save"></i>Guardar</a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-ban">Cancelar</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editar">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Permiso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="permiso">Nombre:</label>
                            <input type="text" class="form-control" name="name" v-model="permiso.name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <a type="button" class="btn btn-sm btn-success pull-center" @click.prevent="editar()">
                                    <i class="fa fa-check">Actualizar</i>
                                </a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-secondary pull-center" data-dismiss="modal">
                                    <i class="fa fa-ban">Cancelar</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        ¿Esta seguro de eliminar el permiso?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="eliminar(permiso)"><i class="fa fa-check"></i> Aceptar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
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
                permisos:[],
                id:'',
                permiso:'',
                guard_name:'',
                permiso:{
                    name:'',
                    guard_rname:''
                }
            }
        },
        methods:{
            listar(){
                let me =this;
                axios.get('http://127.0.0.1:8000/api/permisos')
                .then(function(response){
                    me.permisos=response.data.response;
                })
                .catch(function(error)
                {
                    console.log(error);
                })
            },
            eliminar(permiso){
                let me = this;
                axios.delete('http://127.0.0.1:8000/api/permisos/' + permiso.id)
                .then(response=>{
                    $('#confirmar').modal('hide');
                    me.listar();
                })
                    .catch(function (error){
                    console.log(error);
                })
            },
            modificar(permiso){
                $('#editar').modal({ backdrop: 'static', keyboard: false, show: true });
                this.id=permiso.id;
                this.permiso.name=permiso.name;
            },
             nuevo(){
                $('#create').modal({ backdrop: 'static', keyboard: false, show: true });
            },
            crear(){
                let me = this;
                axios.post('http://127.0.0.1:8000/api/permisos',
                {
                    'name':me.permiso.name,
                    'guard_name':me.permiso.guard_name
                })
                .then(response=>{
                    $('#create').modal('hide');
                    me.listar();
                    me.name='';
                }).catch(error => {
                    me.errors=error.response.data;
                });
            },
            editar(){
                let me = this;
                axios.put('http://127.0.0.1:8000/api/permisos/'+ me.id,
                {
                    'name':me.permiso.name
                })
                .then(response=>{
                    $('#editar').modal('hide');
                    me.listar();
                    me.permiso.name='';
                }).catch(error => {
                    me.errors=error.response.data;
                });
            },
            confirmar(permiso){
                this.permiso.id = permiso.id;
                $('#confirmar').modal({ backdrop: 'static', keyboard: false, show: true });
            }
        },
        mounted() {
            this.listar();
      }
     }
</script>
