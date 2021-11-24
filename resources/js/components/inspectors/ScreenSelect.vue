<template>
    <div>
        <label class="typo__label">Select Screen</label>
        <div class="d-flex">
            <multiselect
                v-model="selected"
                :options="options"
                :multiple="false"
                :close-on-select="true"
                placeholder="Select Form"
                @open="loadOptions"
                :track-by="trackBy"
                :value="selectedOption"
            >
                <template slot="noResult">
                    <slot name="noResult">{{ $t("Not found") }}</slot>
                </template>
                <template slot="noOptions">
                    <slot name="noOptions">{{ $t("No Data Available") }}</slot>
                </template>
            </multiselect>
            <!-- <div class="ml-1 btn-group" role="group">
                <button
                    type="button"
                    class="btn btn-secondary btn-sm"
                    @click="toggleConfigMessage"
                    data-cy="events-list"
                    :title="$t('Configure')"
                >
                    <i class="fa fa-ellipsis-h" />
                </button>
            </div> -->
        </div>
    </div>
</template>

<script>
import { getForms } from "@/aworkflow/api";
export default {
    props: {
        trackBy: {
            type: String,
            default: "id",
        },
    },
    data() {
        return {
            selected: null,
            options: [],
            selectedOption: null,
        };
    },
    methods: {
        async loadOptions() {
            const forms = await getForms();
            const options = [];
            forms.forEach((form) => {
                options.push(form.title);
            });

            this.options = options;
        },
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
