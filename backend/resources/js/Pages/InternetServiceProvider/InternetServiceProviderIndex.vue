<template>
    <div class="container-fluid mb-5 equipment__container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom rdp_statistic_mg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <Link
                                    :href="route('backups.create')"
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
<!--                                <Link-->
<!--                                    :href="route('backup-objects.index')"-->
<!--                                    as="button"-->
<!--                                    method="get"-->
<!--                                    class="btn btn-success mb-5 mr-5"-->
<!--                                >Backup object</Link>-->
                            </div>
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
    name: "InternetServiceProviderIndex",

    components: {
        Link,
    },

}
</script>

<style scoped>

</style>
