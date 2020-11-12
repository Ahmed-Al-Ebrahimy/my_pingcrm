<template>
    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow p-3  rounded sm:rounded-lg">

        <div class="mb-1 flex justify-between">
            <search-filter v-model="form.search" class="w-1/3 max-w-sm ml-1 mr-4" @reset="reset">

            </search-filter>
            <div class="flex   mr-1">
                <inertia-link class="border border-pink-500 bg-indigo-800  text-gray-300 px-3 py-1 shadow-md  hover:bg-indigo-900 rounded-md" :href="route('educationlevels.create')">
                    <span>Create educationlevel</span>
                </inertia-link>
            </div>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="bg-banafsagy-900 text-gray-200">
                <th class="border-2 border-blue-400 px-2 py-1 text-center">ID</th>
                <th class="border-2 border-blue-400 px-2 py-1 text-center">Name</th>
                <th class="border-2 border-blue-400 px-2 py-1 text-center">updated_at</th>
                <th class="border-2 border-blue-400 px-2 py-1 text-center">Created_at</th>
            </tr>
          </thead>
          <tfoot>

          </tfoot>
            <tr v-for="(educationlevel, index) in educationlevels.data" :key="index"  class="text-center font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-purple-300': index % 2 === 0}">

                <td class="text-center border  border-l-2 border-blue-400">
                    <inertia-link class="px-2 py-1 outline-none text-sm flex " :href="route('educationlevels.edit', educationlevel.id)" tabindex="-1">
                    {{ educationlevel.id }}
                    </inertia-link>
                </td>
                <td class="text-center  border border-blue-400">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex " :href="route('educationlevels.edit', educationlevel.id)" tabindex="-1">
                    {{ educationlevel.name }}
                    </inertia-link>
                </td>

                <td class="text-center  border border-blue-400">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex " :href="route('educationlevels.edit', educationlevel.id)" tabindex="-1">
                    {{moment(educationlevel.updated_at).format('YYYY-MM-DD')}}
                    </inertia-link>
                </td>

                <td class="text-center  border border-blue-400">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex " :href="route('educationlevels.edit', educationlevel.id)" tabindex="-1">
                    {{moment(educationlevel.created_at).format('YYYY-MM-DD')}}
                    </inertia-link>
                </td>

            </tr>
            <tr v-if="educationlevels.data.length === 0">
                <td class="text-center  border border-blue-400 px-6 py-4" colspan="4">No educationlevels found.</td>
            </tr>
        </table>
        </div>
        <pagination :links="educationlevels.links" />
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
            Icon,
            Pagination,
            SearchFilter,
        },
        props: {
            educationlevels: Object,
            filters: Object,
        },
  data() {
    return {
      form: {
        search: this.filters.search,
      },
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('educationlevels', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },

    }
</script>


