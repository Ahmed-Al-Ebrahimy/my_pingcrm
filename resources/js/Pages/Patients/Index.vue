<template>
    <!-- <div class="max-w-sm sm:max-w-2xl md:bg-purple-800  md:max-w-xl lg:bg-pink-500 lg:max-w-6xl bg-banafsagy-600  mx-auto my-auto mt-6 p-3 pb-2  rounded shadow-md "> -->

    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow-xl p-3  rounded sm:rounded-lg">
        <!-- <p v-if="$page.flash.message" class="text-sm">{{ $page.flash.message }}</p> -->
         <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.flash.message">
            <div class="flex">
            <div>
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
            </div>
        </div>
        <div class="mb-2 flex justify-between">
            <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
                <label class="block text-gray-700">Trashed:</label>
                <select v-model="form.trashed" class="mt-1 w-full form-select">
                <option :value="null" />
                <option value="with">With Trashed</option>
                <option value="only">Only Trashed</option>
                </select>
            </search-filter>
            Total Rows:-  {{patients.total}}
            <div class="flex items-center  mr-1">
                <inertia-link class="border border-pink-500 bg-indigo-800  text-gray-300 px-3 py-1 shadow-md  hover:bg-indigo-900 rounded-md" :href="route('patients.create')">
                    <span>Create patient</span>
                </inertia-link>
            </div>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="bg-banafsagy-900 text-samaee-900">
                <th class="px-2 py-1 text-sm font-bold text-left">Edit</th>
                <th class="px-2 py-1 text-sm font-bold text-left">ID</th>
                <th class="px-2 py-1 text-sm font-bold text-left">Name</th>
                <th class="px-2 py-1 text-sm font-bold text-left">AddressName</th>
            </tr>
          </thead>
          <tfoot>

          </tfoot>
            <tr v-for="(patient, index) in patients.data" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-purple-300': index % 2 === 0}">
                <td class="border-t w-px ">
                    <inertia-link class="px-4 flex outline-none  items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                    <icon name="edit3" class="block w-6 h-6 "/>
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none text-sm flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                    {{ patient.id }}
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                    {{ patient.name }}
                    </inertia-link>
                </td>

                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('patients.edit', patient.id)" tabindex="-1">
                    {{ patient.address.name }}
                    </inertia-link>
                </td>

            </tr>
            <tr v-if="patients.data.length === 0">
                <td class="border-t px-6 py-4" colspan="6">No patients found.</td>
            </tr>
        </table>
        </div>
        <pagination :links="patients.links" />
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
    patients: Object,
    filters: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('patients', Object.keys(query).length ? query : { remember: 'forget' }))
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


