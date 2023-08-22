<template>
    <div>
        <header-vue />

        <slot />

        <flash />

        <footer-vue/>
    </div>

</template>
<script>
import HeaderVue from "../Components/Header";
import FooterVue from "../Components/Footer";
import Flash from "../Components/Flash";
export default {
    components: {HeaderVue, FooterVue, Flash},
    data(){
        return {
            pathname: location.pathname,
        }
    },
}
</script>
