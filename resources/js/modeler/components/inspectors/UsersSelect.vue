<template>
    <div>
        <label class="typo__label">Usuarios</label>
        <div class="d-flex">
            <multiselect
                v-model="selected"
                :options="options"
                :multiple="true"
                :close-on-select="true"
                placeholder="Pick some"
                label="name"
            >
                <template slot="noResult">
                    <slot name="noResult">{{ $t("Not found") }}</slot>
                </template>
                <template slot="noOptions">
                    <slot name="noOptions">{{ $t("No Data Available") }}</slot>
                </template>
            </multiselect>
            <div class="ml-1 btn-group" role="group">
                <button
                    type="button"
                    class="btn btn-secondary btn-sm"
                    @click="toggleConfigMessage"
                    data-cy="events-list"
                    :title="$t('Configure')"
                >
                    <i class="fa fa-ellipsis-h" />
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selected: null,
            options: [],
        };
    },
};
</script>

<style scoped>
.font-xs {
    font-size: 0.75rem;
}
.btn-link {
    border-style: none !important;
    background: transparent;
    padding: 0px;
}
</style>

<style>
.invalid .multiselect__tags {
    border-color: #dc3545 !important;
}
</style>
