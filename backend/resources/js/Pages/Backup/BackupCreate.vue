<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-flush h-md-100">

                    <div class="card-header">
                        <h3 class="card-title d-flex flex-center">
                            Создание бэкапа
                        </h3>
                    </div>

                    <!--begin::Form-->
                    <form @submit.prevent="createOrganization">
                        <div class="card-body">
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
                                <div style="color: #F64E60" v-if="errors.organization_id">{{error_messages.organization_id}}</div>
                            </div>

                            <div class="form-group">
                                <label>Service <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Service"
                                    v-model="form.service"
                                    :class="{'is-invalid': errors.service}"
                                />
                                <div class="invalid-feedback">{{error_messages.service}}</div>
                            </div>

                            <div class="form-group">
                                <label>Owner<span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Owner"
                                    v-model="form.owner"
                                    :class="{'is-invalid': errors.owner}"
                                />
                                <div class="invalid-feedback">{{error_messages.owner}}</div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form__button">
                                <button type="submit" class="btn btn-success mr-2 button_width">Создать</button>
                                <Link :href="route('backups.index')" as="button" method="get" class="btn btn-primary font-weight-bolder button_width">Назад</Link>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-flush h-md-100">
                    <!--begin::Form-->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Hostname<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Hostname"
                                v-model="form.hostname"
                                :class="{'is-invalid': errors.hostname}"
                            />
                            <div class="invalid-feedback">{{error_messages.hostname}}</div>
                        </div>

                        <div class="form-group">
                            <label>Object<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Object"
                                v-model="form.object"
                                :class="{'is-invalid': errors.object}"
                            />
                            <div class="invalid-feedback">{{error_messages.object}}</div>
                        </div>

                        <div class="form-group">
                            <label>Tool<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Tool"
                                v-model="form.tool"
                                :class="{'is-invalid': errors.tool}"
                            />
                            <div class="invalid-feedback">{{error_messages.tool}}</div>
                        </div>

                        <div class="form-group">
                            <label>DB<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="DB"
                                v-model="form.bd"
                                :class="{'is-invalid': errors.bd}"
                            />
                            <div class="invalid-feedback">{{error_messages.bd}}</div>
                        </div>

                        <div class="form-group">
                            <label>Restricted point<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Restricted point"
                                v-model="form.restricted_point"
                                :class="{'is-invalid': errors.restricted_point}"
                            />
                            <div class="invalid-feedback">{{error_messages.restricted_point}}</div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-flush h-md-100">
                    <!--begin::Form-->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Type<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Type"
                                v-model="form.type"
                                :class="{'is-invalid': errors.type}"
                            />
                            <div class="invalid-feedback">{{error_messages.type}}</div>
                        </div>

                        <div class="form-group">
                            <label>Day<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Day"
                                v-model="form.day"
                                :class="{'is-invalid': errors.day}"
                            />
                            <div class="invalid-feedback">{{error_messages.day}}</div>
                        </div>

                        <div class="form-group">
                            <label>Time start<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Time start"
                                v-model="form.time_start"
                                :class="{'is-invalid': errors.time_start}"
                            />
                            <div class="invalid-feedback">{{error_messages.time_start}}</div>
                        </div>

                        <div class="form-group">
                            <label>Storage server<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Storage server"
                                v-model="form.storage_server"
                                :class="{'is-invalid': errors.storage_server}"
                            />
                            <div class="invalid-feedback">{{error_messages.storage_server}}</div>
                        </div>

                        <div class="form-group">
                            <label>Storage long time<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Storage long time"
                                v-model="form.storage_long_time"
                                :class="{'is-invalid': errors.storage_long_time}"
                            />
                            <div class="invalid-feedback">{{error_messages.storage_long_time}}</div>
                        </div>

                        <div class="form-group">
                            <label>Description storage long time<span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Description storage long time"
                                v-model="form.description_storage_long_time"
                                :class="{'is-invalid': errors.description_storage_long_time}"
                            />
                            <div class="invalid-feedback">{{error_messages.description_storage_long_time}}</div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<script>
import {Link, usePage} from "@inertiajs/inertia-vue3";

export default {
    name: "BackupCreate",

    components: {
        Link
    },

    data() {
        return {
            form: {
                'service': '',
                'owner': '',
                'hostname': '',
                'object': '',
                'tool': '',
                'bd': '',
                'restricted_point': '',
                'type': '',
                'day': '',
                'time_start': '',
                'storage_server': '',
                'storage_long_time': '',
                'description_storage_long_time': '',
                'organization_id': '',
            },
            organizations: null,
            errors: {
                service: false,
                owner: false,
                hostname: false,
                object: false,
                tool: false,
                bd: false,
                restricted_point: false,
                type: false,
                day: false,
                time_start: false,
                storage_server: false,
                storage_long_time: false,
                description_storage_long_time: false,
            },
            error_messages: {
                service: '',
                owner: '',
                hostname: '',
                object: '',
                tool: '',
                bd: '',
                restricted_point: '',
                type: '',
                day: '',
                time_start: '',
                storage_server: '',
                storage_long_time: '',
                description_storage_long_time: '',
            },
        }
    },

    methods: {
        createOrganization() {
            this.resetErrors()

            axios.post('/admin/backups', this.form)
                .then(res => {
                    if (res.status === 201){
                        this.$notify({
                            title: "Создание бэкапа",
                            text: "Строка бэкапа создана!",
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
                            service: errors.hasOwnProperty('service'),
                            owner: errors.hasOwnProperty('owner'),
                            hostname: errors.hasOwnProperty('hostname'),
                            object: errors.hasOwnProperty('object'),
                            tool: errors.hasOwnProperty('tool'),
                            bd: errors.hasOwnProperty('bd'),
                            restricted_point: errors.hasOwnProperty('restricted_point'),
                            type: errors.hasOwnProperty('type'),
                            day: errors.hasOwnProperty('day'),
                            time_start: errors.hasOwnProperty('time_start'),
                            storage_server: errors.hasOwnProperty('storage_server'),
                            storage_long_time: errors.hasOwnProperty('storage_long_time'),
                            description_storage_long_time: errors.hasOwnProperty('description_storage_long_time'),
                            organization_id: errors.hasOwnProperty('organization_id'),
                        };

                        this.error_messages = {
                            service: errors.hasOwnProperty('service') ? errors.service[0] : '',
                            owner: errors.hasOwnProperty('owner') ? errors.owner[0] : '',
                            hostname: errors.hasOwnProperty('hostname') ? errors.hostname[0] : '',
                            object: errors.hasOwnProperty('object') ? errors.object[0] : '',
                            tool: errors.hasOwnProperty('tool') ? errors.tool[0] : '',
                            bd: errors.hasOwnProperty('bd') ? errors.bd[0] : '',
                            restricted_point: errors.hasOwnProperty('restricted_point') ? errors.restricted_point[0] : '',
                            type: errors.hasOwnProperty('type') ? errors.type[0] : '',
                            day: errors.hasOwnProperty('day') ? errors.day[0] : '',
                            time_start: errors.hasOwnProperty('time_start') ? errors.time_start[0] : '',
                            storage_server: errors.hasOwnProperty('storage_server') ? errors.storage_server[0] : '',
                            storage_long_time: errors.hasOwnProperty('storage_long_time') ? errors.storage_long_time[0] : '',
                            description_storage_long_time: errors.hasOwnProperty('description_storage_long_time') ? errors.description_storage_long_time[0] : '',
                            organization_id: errors.hasOwnProperty('organization_id') ? errors.organization_id[0] : '',
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
                service: '',
                owner: '',
                hostname: '',
                object: '',
                tool: '',
                bd: '',
                restricted_point: '',
                type: '',
                day: '',
                time_start: '',
                storage_server: '',
                storage_long_time: '',
                description_storage_long_time: '',
                organization_id: '',
            };
        },

        resetErrors(){
            this.errors = {
                service: false,
                owner: false,
                hostname: false,
                object: false,
                tool: false,
                bd: false,
                restricted_point: false,
                type: false,
                day: false,
                time_start: false,
                storage_server: false,
                storage_long_time: false,
                description_storage_long_time: false,
            };
        },

        getOrganizations(){
            axios.get('/admin/organization-all-collection')
                .then(res => {
                    this.organizations = res.data.data.organizations;
                })
        },
    },

    mounted() {
        this.getOrganizations();
    }
}
</script>

<style scoped>
.form__button {
    display: flex;
    justify-content: space-between;
}

.button_width {
    width: 50%;
}
</style>
