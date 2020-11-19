<template>
<app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow-xl p-3  rounded sm:rounded-lg">
                    <div class="bg-white rounded shadow overflow-x-auto">

                        <div>
                           <span>clinic1</span>
                           <div v-for="(patient, index) in clinic1" :key="index">{{patient.name}}</div>
                       </div>

                        <div>
                           <span>clinic2</span>
                           <div v-for="(patient, index) in clinic2" :key="index">{{patient.name}}</div>
                       </div>

                        <div>
                           <span>clinic3</span>
                           <div v-for="(patient, index) in clinic3" :key="index">{{patient.name}}</div>
                       </div>

                        <div>
                           <span>clinic4</span>
                           <div v-for="(patient, index) in clinic4" :key="index">{{patient.name}}</div>
                       </div>



                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Icon from '@/Shared/Icon'
    import mapValues from 'lodash/mapValues'
    import Pagination from '@/Shared/Pagination'
    import pickBy from 'lodash/pickBy'
    import SearchFilter from '@/Shared/SearchFilter'
    import throttle from 'lodash/throttle'
    export default {
        components: {
            AppLayout,
            Welcome,
            Pagination,
            Icon,
            SearchFilter,
        },
  props: {
    clinic1: Array,
    clinic2: Array,
    clinic3: Array,
    clinic4: Array,
  },
  data() {
    return {
    }
  },
  methods: {
  },

    }
</script>


