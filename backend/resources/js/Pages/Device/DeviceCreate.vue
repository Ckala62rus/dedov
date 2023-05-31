<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-flush h-md-100">

                    <div class="card-header">
                        <h3 class="card-title">
                            Создание оборудования
                        </h3>
                    </div>

                    <!--begin::Form-->
                    <form @submit.prevent="createOrganization">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Хост <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Hostname"
                                    v-model="form.hostname"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Модель <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Model"
                                    v-model="form.model"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Дата покупки <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Date bue"
                                    v-model="form.date_buy"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Какие сервисы развернуты <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Description service"
                                    v-model="form.description_service"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success mr-2">Создать</button>
                            <Link :href="route('devices.index')" as="button" method="get" class="btn btn-primary font-weight-bolder">Назад</Link>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-flush h-md-100">
                    <!--begin::Form-->
                    <form @submit.prevent="createOrganization">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Желаемый срок замены <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Date update"
                                    v-model="form.date_update"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Операционная система <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Operation system"
                                    v-model="form.operation_system"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Модель и количество процессоров <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="CPU"
                                    v-model="form.cpu"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Кол-во физ. Ядер <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Count Core"
                                    v-model="form.count_core"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Кол-во ядер с учетом HT <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Count Core With HT"
                                    v-model="form.count_core_with_ht"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Оперетивная память, Mb <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Memory"
                                    v-model="form.memory"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-flush h-md-100">
                    <!--begin::Form-->
                    <form @submit.prevent="createOrganization">
                        <div class="card-body">
                            <div class="form-group">
                                <label>HDD, Gb <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="HDD, Gb"
                                    v-model="form.hdd"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>SSD, Gb <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="SSD, Gb"
                                    v-model="form.ssd"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Где находится (адрес) <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Address"
                                    v-model="form.address"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>
                            <div class="form-group">
                                <label>Комментарий <span class="text-danger">*</span></label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    placeholder="Comment"
                                    v-model="form.comment"
                                    :class="{'is-invalid': errors.errorName}"
                                />
                                <div class="invalid-feedback">Название типа оборудования, обязательно!</div>
                            </div>

                            <label>Организация</label>
                            <div class="form-group select-form_group">
                                <el-select
                                    v-model="form.organization_id"
                                    class="m-0 select-category w-100"
                                    placeholder="Организация"
                                    size="large"
                                >
                                    <el-option
                                        v-for="organization in organizations"
                                        :key="organization.id"
                                        :label="organization.name"
                                        :value="organization.id"
                                    />
                                </el-select>
                            </div>

                            <label>Тип оборудования</label>
                            <div class="form-group select-form_group">
                                <el-select
                                    v-model="form.equipment_id"
                                    class="m-0 select-category w-100"
                                    placeholder="Тип оборудования"
                                    size="large"
                                >
                                    <el-option
                                        v-for="equipment in equipments"
                                        :key="equipment.id"
                                        :label="equipment.name"
                                        :value="equipment.id"
                                    />
                                </el-select>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link, usePage} from "@inertiajs/inertia-vue3";

export default {
    name: "DeviceCreate",
    components: {
        Link
    },
    data() {
        return {
            form: {
                'hostname' : '',
                'model' : '',
                'date_buy' : '',
                'description_service' : '',
                'date_update' : '',
                'operation_system' : '',
                'cpu' : '',
                'count_core' : '',
                'count_core_with_ht' : '',
                'memory' : '',
                'hdd' : '',
                'ssd' : '',
                'address' : '',
                'comment' : '',
                'user_id' : '',
                'organization_id' : '',
                'equipment_id' : '',
            },
            organizations: null,
            equipments: null,
            errors: {
                errorName: false,
            },
        }
    },

    methods: {
        createOrganization() {
            this.resetErrors()

            axios.post('/admin/devices', this.form)
                .then(res => {
                    if (res.status === 201){
                        this.$notify({
                            title: "Создание оборудования",
                            text: "Оборудование создано!",
                            speed: 1000,
                            duration: 1000,
                            type: 'success'
                        });

                        this.resetForm();
                    }
                })
                .catch(err => {
                    let errors = err.response.data.errors

                    if (err.response.status === 422) {
                        this.errors = {
                            errorName: errors.hasOwnProperty('name'),
                        };
                        this.$notify({
                            title: "Ошибка",
                            text: "Ошибка в заполнении полей",
                            speed: 1000,
                            duration: 1000,
                            type: 'error'
                        });
                    }
                })
        },

        resetForm(){
            this.form = {
                name: '',
                description: '',
            };
        },

        resetErrors(){
            this.errors = {
                errorName: false
            };
        },

        getOrganizations(){
            axios.get('/admin/organization-all-collection')
                .then(res => {
                    this.organizations = res.data.data.organizations;
                })
        },

        getEquipments(){
            axios.get('/admin/equipments-all-collection')
                .then(res => {
                    this.equipments = res.data.data.equipments;
                })
        },
    },

    mounted() {
        this.getOrganizations();
        this.getEquipments();
        this.form.user_id = this.$page.props.auth.user.id;
    }
}
</script>

<style scoped>

</style>
