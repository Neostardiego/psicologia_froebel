<template>
  <div class="content-wrapper">
            <div class="content-body">
                <!-- card actions section start -->
                <section id="card-actions">
                    <!-- Info table about action starts -->
                    <div class="row d-flex align-items-center">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-primary  pt-1 pb-1">
                                    <h4 class="card-title text-white"><i class="fa fa-user"></i> Hola: {{perfil.name}}</h4>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                   
                                                    <div class="col-md-12">
                                                        <div class="form-group" :class="{'has-danger': errors.plan_id}">
                                                            <label class="control-label w-100"><b>Plan Actual</b> </label>
                                                            <span  class="pl-2">{{perfil.queries[0].planes.description}}</span>
                                                        </div>
                                                    </div>
                                                        <div class="col-md-12">
                                                        <div class="form-group" :class="{'has-danger': errors.plan_id}">
                                                            <label class="control-label w-100"><b>Total Consultas Realizadas</b> </label>
                                                                <span  class="pl-2">{{perfil.queries[0].quantity}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group" :class="{'has-danger': errors.email}">
                                                            <label class="control-label w-100"><b>Token</b></label>
                                                               <span  class="pl-2"> {{perfil.api_token}}</span>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Info table about action Ends -->
                </section>
                <!-- // card-actions section end -->

            </div>
        </div>  

       
</template>
 
<style>
.el-input__inner{
    width:100% !important;
}

</style>
<script>
//import {EventBus} from '../../../helpers/bus'

    export default {
        props: ['perfil'],
        data() {
            return {
                loading_submit: false,
                titleDialog: null,
                resource: 'users',
                errors: {},
                form: {},
                types: [],
                show_levels:false,
                array_plan:[],
                loader: false,
                text_loader: '',
                typeUsuario:null
            }
        },

        async created() {
            console.log(this.perfil)
         },
        methods: {
            initForm() {
                this.errors = {}
                 
 
            },
            create() {

                if (this.recordId) {
                    this.loader=true
                    this.text_loader = 'Espere porfavor'
                    this.$http.get(`/${this.resource}/record/${this.recordId}`)
                        .then(response => {
                            console.log(response.data.data.type)
                            this.typeUsuario=response.data.data.type
                            this.form = response.data.data
                            this.form.new_password=null
                            this.loader=false
                            this.text_loader = ''
                        })
                }
            },
           
            submit() {
                // console.log(this.form)
                this.loading_submit = true
                this.$http.post(`/${this.resource}`, this.form)
                    .then(response => {
                        if (response.data.success) {
                            this.form.password = null
                            this.form.password_confirmation = null
                            this.$message.success(response.data.message)
                            this.$eventHub.$emit('reloadData')
                            this.close()
                        } else {
                            this.$message.error(response.data.message)
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data
                        } else {
                            this.$message.error(error.response.data.message);
                            console.log(error)
                        }
                    })
                    .then(() => {
                        this.loading_submit = false
                    })
            },
            close() {
                this.$emit('update:mostrar_form', false)
                 this.$emit('update:recordId', null)
                this.initForm()
            },
        }
    }
</script>
