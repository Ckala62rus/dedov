<template>
    <div class="container-fluid mb-5 equipment__container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom rdp_statistic_mg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <Link
                                    :href="route('isp.create')"
                                    as="button"
                                    method="get"
                                    class="btn btn-success mb-5"
                                >
                                    Create new record
                                </Link>

                                <button
                                    type="submit"
                                    class="btn btn-info mb-5 ml-10"
                                    @click.prevent="findByFilter"
                                >Find</button>

                                <button
                                    type="submit"
                                    class="btn btn-dark mb-5 ml-5"
                                    @click.prevent="clearFilter"
                                >Clear filter</button>

                                <button
                                    type="submit"
                                    class="btn btn-primary mb-5 ml-5"
                                    @click="toExcel"
                                >Export Excel</button>
                            </div>
                            <div class="col-md-4">
                                <Link
                                    :href="route('channel-types.index')"
                                    as="button"
                                    method="get"
                                    class="btn btn-success mb-5 mr-5"
                                >Channel types</Link>
                                <Link
                                    :href="route('internet-speed.index')"
                                    as="button"
                                    method="get"
                                    class="btn btn-success mb-5 mr-5"
                                >Internet Speed</Link>
                            </div>
                        </div>

                        <v-server-table
                            :url="url"
                            :columns="columns"
                            :options="options"
                            ref="isp-table"
                        >
                            <template v-slot:actions="{row}">

                                <div class="action__isp">
                                    <Link :href="route('isp.edit', {id: row.id})" method="get" v-if="row.can_action">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Edit.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                    </Link>

                                    <a href="javascript:;" @click="deleteIsp(row)" v-if="row.can_action">
                                      <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-10-29-133027/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
                                                    <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                      </span>
                                    </a>
                                </div>

                            </template>
                        </v-server-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link, usePage} from "@inertiajs/inertia-vue3";

export default {
    name: "InternetServiceProviderIndex",

    components: {
        Link,
    },

    data() {
        return {
            urlPrepare: '/admin/isp-all-paginate?',
            url: '/admin/isp-all-paginate?',
            columns: [
                'id',
                'organization',
                'internet_speed_name',
                'channel_type',
                'static_ip_address',
                'schema_org_channel_provider',
                'cost',
                'cost_participant_1',
                'cost_participant_2',
                'cost_participant_3',
                'cost_participant_4',
                'cost_participant_5',
                'cost_participant_6',
                'comment',
                'actions'
            ],
            options: {
                // see the options API
                // https://github.com/matfish2/vue-tables-2/blob/master/lib/config/defaults.js
                perPage: 500,
                editableColumns:['text'],
                headings: {
                    id: 'id',
                    organization: 'Org',
                    internet_speed_name: 'Internet speed',
                    channel_type: 'Channel type',
                    static_ip_address: 'Static ip address',
                    schema_org_channel_provider: 'Schema org channel provider',
                    cost: 'Cost',

                    created_at: 'Время создания',
                    updated_at: 'Время обновления',
                    comment: 'Comment',
                    actions: 'Actions',
                },
                texts: {
                    limit: 'Вывод записей',
                    count: "Показано с {from} по {to} из {count} записей|{count} записей|Одна запись",
                    noResults: "Ничего не нашлось",
                    loading: "Загрузка...",
                },
                // perPageValues: [2,10,25,30,35,50,100],
                perPageValues: [],
                skin: "VueTables__table " +
                    "table " +
                    "table-striped " +
                    "table-bordered " +
                    "VueTables__child-row " +
                    "table-vue-width " +
                    "table-hover ",
                filterable: false,
                requestAdapter: function(data) {
                    return data;
                },
                responseAdapter: function(resp) {
                    var data = this.getResponseData(resp);

                    return {
                        data: data.data,
                        count: data.count
                    };
                },
            },
        }
    },

    methods: {
        deleteIsp(row){
            Swal.fire({
                title: 'Удалить ISP?',
                text: "Выбранный ISP будет удален",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Да, удалить',
                cancelButtonText: 'Отмена',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/admin/isp/' + row.id).then(response => {
                        if (response.data.status === true) {
                            this.$notify({
                                group: 'foo',
                                type: 'success',
                                title: 'Удаление ISP',
                                text: 'ISP успешно удален'
                            });
                            Swal.fire(
                                'Удалено!',
                                'ISP удален',
                                'success'
                            )
                            this.$refs['isp-table'].refresh();
                        }
                        if (response.data.status === false) {
                            this.$notify({
                                group: 'foo',
                                type: 'error',
                                title: 'Удаление ISP',
                            });
                            Swal.fire(
                                'Ошибка!',
                                response.data.message,
                                'error'
                            )
                        }
                    });
                }
            })
        },
    },
}
</script>

<style scoped>

.action__isp {
    width: 52px;
}

</style>
