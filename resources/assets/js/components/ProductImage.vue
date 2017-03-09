<template>
    <div class="center-block" :style="{ backgroundImage: 'url(' + src + ')' }"></div>
</template>

<style scoped>
    div {
        height: 100px;
        width: 100px;
        border-radius: 100%;
        content: ' ';
        background-size: cover;
    }
</style>

<script>
    export default {
        props: ['src'],
    }

</script>
