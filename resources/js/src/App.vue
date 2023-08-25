<template>
    <main class="main">
       <doc-generete-forma />
    </main>
</template>

<script>
import DocGenereteForma from "@/Components/docGenereteForma.vue";
import { defineComponent } from 'vue';

export default defineComponent({
    components: {
        DocGenereteForma
    },
    setup() {
        return {

        };
    },
});
</script>

<style lang="scss" scoped>
.main {
    width: 992px;
    margin: 0 auto;
    padding: 40px;
}
</style>
