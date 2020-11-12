<template>
<app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow-xl p-3  rounded sm:rounded-lg">
                    <div class="mb-2 flex justify-between">
                        <search-filter v-model="form.search" class="w-full max-w-sm mr-4" @reset="reset">
                            <label class="block text-gray-700">Trashed:</label>
                            <select v-model="form.trashed" class="mt-1 w-full form-select">
                            <option :value="null" />
                            <option value="with">With Trashed</option>
                            <option value="only">Only Trashed</option>
                            </select>
                        </search-filter>
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
                                    <th class="border-2 border-blue-400 px-2 py-1 text-center">الرقم</th>
                                    <th class="border-2 border-blue-400 px-2 py-1 text-center">الاسم</th>
                                    <th class="border-2 border-blue-400 px-2 py-1 text-center">الموعد</th>
                                    <th class="border-2 border-blue-400 px-2 py-1 text-center">اخر مراجعة</th>
                                    <th class="border-2 border-blue-400 px-2 py-1 text-center">اخر تعديل</th>
                                </tr>
                            </thead>
                            <tr v-for="(patient, index) in patients.data" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-purple-300': index % 2 === 0}">

                                <td class="border border-l-2  border-blue-400">
                                    <inertia-link class="px-1 py-1 outline-none flex" :href="route('patients.edit', patient.id)">
                                    {{ patient.id }}
                                    </inertia-link>
                                </td>

                                <td class="border border-blue-400">
                                    <inertia-link class="px-1 py-1 outline-none flex" :href="route('patients.edit', patient.id)" tabindex="-1">
                                    {{ patient.name }}
                                    </inertia-link>
                                </td>

                                <td class="border border-blue-400">
                                    <inertia-link class="px-1 py-1 outline-none flex" :href="route('patients.edit', patient.id)" tabindex="-1">
                                    {{
                                       !patient.last_visit ? 'غير معروف' :
                                       !patient.last_visit.next_visit  ? 'غير معروف'
                                        : moment(patient.last_visit.next_visit).format('YYYY-MM-DD')

                                    }}
                                    </inertia-link>
                                </td>

                                <td class="border border-blue-400">
                                    <inertia-link class="px-1 py-1 outline-none flex" :href="route('patients.edit', patient.id)" tabindex="-1">
                                    {{
                                       patient.last_visit ? moment(patient.last_visit.created_at).format('YYYY-MM-DD') : 'غير معروف'

                                    }}
                                    </inertia-link>
                                </td>

                                <td class="border  border-blue-400">
                                    <inertia-link class="px-1 py-1 outline-none flex" :href="route('patients.edit', patient.id)" tabindex="-1">
                                    {{moment(patient.updated_at).format('YYYY-MM-DD, h:m a')}}
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


