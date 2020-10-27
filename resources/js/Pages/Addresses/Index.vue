<template>
    <div class="lg:max-w-4xl bg-gray-100 shadow mx-auto p-4 mt-6">
        <!-- <p v-if="$page.flash.message" class="text-sm">{{ $page.flash.message }}</p> -->
         <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="$page.flash.message">
            <div class="flex">
            <div>
                <p class="text-sm">{{ $page.flash.message }}</p>
            </div>
            </div>
        </div>
        <div class="mb-3 flex justify-between ">
            <div class="flex items-center">
                <div class="flex w-full bg-white shadow rounded">
                <input class="relative w-full px-3 py-2 rounded focus:shadow-outline focus:border-blue-600" v-model="term" autocomplete="off" type="text" id="search" placeholder="Search…">
                </div>
                <button class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500" type="button" @click="reset">Reset</button>
            </div>
            <div class="flex items-center border-t first:border-t-0 ">
                <inertia-link class="bg-gray-700 px-3 py-2   text-white hover:bg-cool-gray-700 rounded-md" :href="route('addresses.create')">
                    <span>Create Address</span>
                </inertia-link>
            </div>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-no-wrap">
            <tr class="bg-gray-900 text-white">
                <th class="px-2 py-1 text-sm font-bold text-left">No.</th>
                <th class="px-2 py-1 text-sm font-bold text-left" colspan="2">name</th>
            </tr>
            <tr v-for="(address, index) in addresses.data" :key="index"  class="hover:bg-gray-100 focus-within:bg-gray-100 " :class="{'bg-gray-300': index % 2 === 0}">
                <td class="border-t">
                    <inertia-link class="px-2 py-1 text-sm flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    {{ address.id }}
                    </inertia-link>
                </td>
                <td class="border-t">
                    <inertia-link class="px-2 py-1 text-sm flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    {{ address.name }}
                    </inertia-link>
                </td>

                <td class="border-t w-px">
                    <inertia-link class="px-4 flex items-center" :href="route('addresses.edit', address.id)" tabindex="-1">
                    <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                    </inertia-link>
                </td>
            </tr>
            <tr v-if="addresses.data.length === 0">
                <td class="border-t px-6 py-4" colspan="4">No addresses found.</td>
            </tr>
        </table>
        </div>
        <pagination :links="addresses.links"/>
    </div>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import Icon from '@/Shared/Icon'
    import Pagination from '@/Shared/Pagination'

    import _ from 'lodash'

    export default {
         layout: AppLayout,
        components: {
            Welcome,
            Pagination,
            Icon,
        },
        props: ['addresses', 'errors'],

        data() {
            return {
                term: '',
            }
        },
        watch: {
          term: {
            handler: _.throttle(function() {
                this.$inertia.replace(this.route('addresses', {term: this.term}))
            }, 200),
            deep: true,
            },
        },
        methods: {
            reset() {
                this.term =  null;
            },
        },

    }
</script>


