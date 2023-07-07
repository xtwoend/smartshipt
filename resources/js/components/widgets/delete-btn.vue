<template>
<div class="dd" v-click-outside="hide">
    <div id="list1" class="dropdown-check-list" tabindex="100">
        <span class="anchor form-control" @click="showDropdown" v-if="type=='select'">
            Select Parameter
        </span>
        <span class="icon" v-if="type=='icon'" @click="showDropdown">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-horizontal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 6l8 0"></path>
                <path d="M16 6l4 0"></path>
                <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M4 12l2 0"></path>
                <path d="M10 12l10 0"></path>
                <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M4 18l11 0"></path>
                <path d="M19 18l1 0"></path>
            </svg>
        </span>
        <ul class="items" v-if="show">
            <li v-for="(option, index) in groups" :key="index">
                <div v-if="Array.isArray(option)">
                    <span>{{ index }}</span>
                    <div v-for="(row, i) in option" :key="i">
                        <input type="checkbox" :id="i" :value="row" v-model="selected">
                        <label :for="i">{{ row.text }}</label>
                    </div>
                </div>
                <div v-if="!Array.isArray(option)">
                    <input type="checkbox" :id="index" :value="option" v-model="selected">
                    <label :for="index">{{ option.text }}</label>
                </div>
            </li>
        </ul>
    </div>
</div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'
export default {
    props: {
        options: Array,
        type: {
            type: String,
            default: 'select'
        },
        default: {
            type: Array,
            default: () => {
                return [];
            }
        }
    },
    data() {
        return {
            show: false,
            selected: this.default
        }
    },
    methods: {
        showDropdown() {
            this.show = ! this.show
        },
        hide(){
            this.show = false
        },
        groupBy(x, f) {
            return x.reduce((a,b,i)=>((a[f(b,i,x)]||=[]).push(b),a),{});
        }
    },
    computed:  {
        groups () {
            if(this.options[0].hasOwnProperty('group')) {
                return this.groupBy(this.options, v => v.group)
            }
            return this.options;
        }
    },
    watch: {
        selected(val) {
            this.$emit('checked', val)
        }
    },
    directives: {
        clickOutside: vClickOutside.directive
    },
}
</script>

<style lang="scss">
.dropdown-check-list {
    display: inline-block;
    position: relative;

}

.dropdown-check-list .anchor {
    position: relative;
    cursor: pointer;
    display: inline-block;
    // padding: 5px 50px 5px 10px;
    // border: 1px solid #ccc;
    // border-radius: 0.25rem;
    border: 1px solid #616876;
    min-width: 300px;
}

.dropdown-check-list .anchor:after {
    position: absolute;
    content: "";
    border-left: 2px solid black;
    border-top: 2px solid black;
    padding: 5px;
    right: 10px;
    top: 20%;
    -moz-transform: rotate(-135deg);
    -ms-transform: rotate(-135deg);
    -o-transform: rotate(-135deg);
    -webkit-transform: rotate(-135deg);
    transform: rotate(-135deg);
}

.dropdown-check-list .anchor:active:after {
    right: 8px;
    top: 21%;
}

.dropdown-check-list ul.items {
    padding: 2px;
    margin: 0;
    border: 1px solid #616876;
    border-top: none;
    position: absolute;
    z-index: 99;
    // width: 100%;
    background: #fff;
    min-width: 300px;
    text-align: left;
}

.dropdown-check-list ul.items li {
    list-style: none;
    padding: 5px 10px 5px 10px;
    label {
        font-size: inherit;
        font-weight: 400;
        margin-bottom: 0 !important;
        margin-left: 15px;
    }
}

.dropdown-check-list.visible .anchor {
    color: #0094ff;
}

.dropdown-check-list.visible .items {
    display: block;
}
</style>
