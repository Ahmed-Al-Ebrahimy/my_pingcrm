<template>
    <table class="table table-bordered t1 text-center table-sm table-responsive{-sm|-md|-lg|-xl}">
        <thead class="thead-da">
            <tr>
                <th v-for="column in columns" :key="column.name" :style="'width:'+column.width"> {{column.label}}</th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>
    export default {
        props: ['columns']
    }
</script>
