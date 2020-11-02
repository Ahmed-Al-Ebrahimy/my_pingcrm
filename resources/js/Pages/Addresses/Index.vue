<template>
    <!-- <div class="max-w-sm sm:max-w-2xl md:bg-purple-800  md:max-w-xl lg:bg-pink-500 lg:max-w-6xl bg-banafsagy-600  mx-auto my-auto mt-6 p-3 pb-2  rounded shadow-md "> -->

    <app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-banafsagy-600 overflow-hidden shadow p-3  rounded sm:rounded-lg">
        <!-- <p v-if="$page.flash.message" class="text-sm">{{ $page.flash.message }}</p> -->
         <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.flash.message">
            <!-- <div class="flex">
            <div>
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
            </div> -->
            <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto" scroll-region>
                <flash-messages />
            <slot />
          </div>
        </div>
        <div class="mb-1 flex justify-between">
        <search-filter v-model="form.search" class="w-1/3 max-w-sm ml-1 mr-4" @reset="reset">

      </search-filter>
            <div class="flex items-center  mr-1">
                <inertia-link class="border border-pink-500 bg-indigo-800  text-gray-300 px-3 py-1 shadow-md  hover:bg-indigo-900 rounded-md" :href="route('addresses.create')">
                    <span>Create Address</span>
                </inertia-link>
            </div>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="bg-banafsagy-900 text-samaee-900">
                <th class="px-2 py-1 text-sm font-bold text-left">Edit</th>
                <th class="px-2 py-1 text-sm font-bold text-left">ID</th>
                <th class="px-2 py-1 text-sm font-bold text-left">name</th>
                <th class="px-2 py-1 text-sm font-bold text-left">Created_at</th>
            </tr>
          </thead>
          <tfoot>

          </tfoot>
            <tr v-for="(address, index) in addresses.data" :key="index"  class="font-medium text-gray-800 hover:bg-purple-400 focus-within:bg-gray-100 " :class="{'bg-purple-300': index % 2 === 0}">
                <td class="border-t w-px ">
                    <inertia-link class="px-4 flex outline-none  items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    <icon name="edit3" class="block w-6 h-6 "/>
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none text-sm flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    {{ address.id }}
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    {{ address.name }}
                    </inertia-link>
                </td>

                <td class="border-t">
                    <inertia-link class="px-2 py-1 outline-none  text-sm flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    {{moment(address.created_at).format('YYYY-MM-DD')}}
                    </inertia-link>
                </td>

            </tr>
            <tr v-if="addresses.data.length === 0">
                <td class="border-t px-6 py-4" colspan="4">No addresses found.</td>
            </tr>
        </table>
        </div>
        <pagination :links="addresses.links" />
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

     import FlashMessages from '@/Shared/FlashMessages'

    export default {
        components: {
            AppLayout,
            Welcome,
            Icon,
            Pagination,
            SearchFilter,

            FlashMessages,
        },
        props: {
            addresses: Object,
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
        this.$inertia.replace(this.route('addresses', Object.keys(query).length ? query : { remember: 'forget' }))
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


