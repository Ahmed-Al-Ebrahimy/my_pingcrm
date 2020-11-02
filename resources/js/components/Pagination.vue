<template>
    <nav class="pagination is-rounded">

        <span class="page-stats ">Showing ({{pagination.from}} - {{pagination.to}})  of ({{pagination.total}} Total Records)</span>

        <a v-if="pagination.prevPageUrl" class="button is-small pagination-previous" @click="$emit('prev');">Prev</a>

        <a class="button is-small pagination-previous" v-else :disabled="true"> Prev </a>


        <a v-if="pagination.nextPageUrl" class="button is-small pagination-next" @click="$emit('next');">Next</a>

        <a class="button is-small pagination-next" v-else :disabled="true">Next </a>
    </nav>


</template>

<script>
    export default {
        props: ['pagination', 'filtered']
    }
</script>

<style  scoped>
    .pagination {
        justify-content: flex-end !important;
    }
    .page-stats {
        margin-right: 5px;
        background-color:rgb(129, 235, 143);
        border-radius:0px;
        font-size:1rem;
        padding:calc(.375em - 1px) .5em;
        margin:.25rem;
    }
    .pagination{
    font-size:1rem;
    margin:-.25rem
}
.pagination.is-small{
    font-size:.75rem
}
.pagination.is-medium{
    font-size:1.25rem
}
.pagination.is-large{
    font-size:1.5rem
}
.pagination.is-rounded .pagination-next,.pagination.is-rounded .pagination-previous{
    padding-left:1em;
    padding-right:1em;
    border-radius:290486px
}
.pagination.is-rounded .pagination-link{
    border-radius:290486px
}

.pagination-ellipsis,
.pagination-link,
.pagination-next,
.pagination-previous{
    border:1px solid transparent;border-radius:3px;
    display:-ms-inline-flexbox;
    display:inline-flex;
    font-size:1rem;
    height:2.25em;
    justify-content:flex-start;
    line-height:1.5;
    padding-left:calc(.625em - 1px);
    padding-right:calc(.625em - 1px);
    position:relative;
    vertical-align:top;
    user-select:none;
    font-size:1em;
    padding:calc(.375em - 1px) .5em;
    justify-content:center;margin:.25rem;
    text-align:center
}


.pagination-ellipsis[disabled],.pagination-link[disabled],
.pagination-next[disabled],
.pagination-previous[disabled]{
    cursor:not-allowed
}

.pagination-link,.pagination-next,.pagination-previous{
    border-color:#14d030;
    color:#1634cb;
    min-width:2.25em
}

.pagination-link:hover,.pagination-next:hover,.pagination-previous:hover{
    border-color:#0e08cc;
    color:#1221c4
}

.pagination-link:focus,.pagination-next:focus,.pagination-previous:focus{
    border-color:#3273dc
}

.pagination-link:active,.pagination-next:active,.pagination-previous:active{
  box-shadow:inset 0 1px 2px rgba(228, 199, 199, 0.2)
}

.pagination-link[disabled],
.pagination-next[disabled],
.pagination-previous[disabled]{
    background-color:#dbdbdb;
    border-color:#dbdbdb;
    -webkit-box-shadow:none;
    box-shadow:none;
    color:#7a7a7a;
    opacity:.5
}
.pagination-next,.pagination-previous{
    padding-left:.75em;
    padding-right:.75em;
    white-space:nowrap
}

.pagination-link.is-current{
    background-color:#3273dc;
    border-color:#3273dc;
    color:#fff
}

.pagination-ellipsis{
    color:#b5b5b5;pointer-events:none
}
.pagination-list{
    -ms-flex-wrap:wrap;flex-wrap:wrap
}

.pagination.is-centered .pagination-previous{
    -ms-flex-order:1;
     order:1

}
.pagination.is-centered .pagination-list{
    -ms-flex-pack:center;
    justify-content:center;
}
</style>
