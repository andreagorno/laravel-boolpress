<template>
    <header>
        <nav>
            <ul>
                <li>
                    <!-- <a href="#" class="active">Home</a> -->

                    <!-- use router-link component for navigation. -->
                    <!-- specify the link by passing the `to` prop. -->
                    <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
                    <router-link :to="{ name: 'home' }">Home</router-link>
                </li>
                <li>
                    <!-- <a href="#">Blog</a> -->
                    <router-link :to="{ name: 'blog' }">Blog</router-link>
                </li>
                <li>
                    <!-- <a href="#">Chi Siamo</a> -->
                    <router-link :to="{ name: 'about' }">Chi Siamo</router-link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>
    header {
        text-align: center;
        margin-top: 30px;

        li {
            display: inline-block;

            a {
                color: black;
                font-size: 18px;
                text-decoration: none;
                padding: 5px 10px;

                &.active,
                &:hover {
                    background-color: lightblue;
                }
            }
        }
    }
</style>